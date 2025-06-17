<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyRequest;
use App\Repositories\AgencyRepository;
use App\Repositories\AgencyTypeRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    protected $agencyRepository;
    protected $agencyTypeRepository;
    protected $userRepository;

    public function __construct(
        AgencyRepository $agencyRepository,
        AgencyTypeRepository $agencyTypeRepository,
        UserRepository $userRepository
    ) {
        $this->agencyRepository = $agencyRepository;
        $this->agencyTypeRepository = $agencyTypeRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $agencies = $this->agencyRepository->paginate();
        return view('admin.agencies.index', compact('agencies'));
    }

    public function create()
    {
        $users = $this->userRepository->all();
        $agencyTypes = $this->agencyTypeRepository->getActive();
        return view('admin.agencies.create', compact('users', 'agencyTypes'));
    }

    public function store(AgencyRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        
        $this->agencyRepository->create($data);
        
        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit($id)
    {
        $agency = $this->agencyRepository->getWithRelations($id);
        $users = $this->userRepository->all();
        $agencyTypes = $this->agencyTypeRepository->getActive();
        return view('admin.agencies.edit', compact('agency', 'users', 'agencyTypes'));
    }

    public function update(AgencyRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        
        $this->agencyRepository->update($id, $data);
        
        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy($id)
    {
        $this->agencyRepository->delete($id);
        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function updateAccreditationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|array',
            'status.en' => 'required|string|max:255',
            'status.ar' => 'required|string|max:255',
        ]);

        $this->agencyRepository->updateAccreditationStatus($id, $request->status);
        
        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
} 