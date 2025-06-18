<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LicenseRequest;
use App\Repositories\LicenseRepository;
use App\Repositories\LicenseTypeRepository;
use App\Repositories\AgencyRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    protected $licenseRepository;
    protected $licenseTypeRepository;
    protected $agencyRepository;
    protected $userRepository;

    public function __construct(
        LicenseRepository $licenseRepository,
        LicenseTypeRepository $licenseTypeRepository,
        AgencyRepository $agencyRepository,
        UserRepository $userRepository
    ) {
        $this->licenseRepository = $licenseRepository;
        $this->licenseTypeRepository = $licenseTypeRepository;
        $this->agencyRepository = $agencyRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $licenses = $this->licenseRepository->paginate();
        return view('admin.licenses.index', compact('licenses'));
    }

    public function create()
    {
        $licenseTypes = $this->licenseTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        $users = $this->userRepository->all();
        return view('admin.licenses.create', compact('licenseTypes', 'agencies', 'users'));
    }

    public function store(LicenseRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        $this->licenseRepository->create($data);
        
        return redirect()->route('admin.licenses.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function show($id)
    {
        $license = $this->licenseRepository->getWithRelations($id);
        return view('admin.licenses.show', compact('license'));
    }

    public function edit($id)
    {
        $license = $this->licenseRepository->getWithRelations($id);
        $licenseTypes = $this->licenseTypeRepository->getActive();
        $agencies = $this->agencyRepository->all();
        $users = $this->userRepository->all();
        return view('admin.licenses.edit', compact('license', 'licenseTypes', 'agencies', 'users'));
    }

    public function update(LicenseRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        
        $this->licenseRepository->update($id, $data);
        
        return redirect()->route('admin.licenses.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy($id)
    {
        $this->licenseRepository->delete($id);
        return redirect()->route('admin.licenses.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function getAgentsByAgency(Request $request)
    {
        $agencyId = $request->get('agency_id');
        if (!$agencyId) {
            return response()->json([]);
        }

        $agents = \App\Models\Agent::where('agency_id', $agencyId)->get();
        return response()->json($agents);
    }
} 