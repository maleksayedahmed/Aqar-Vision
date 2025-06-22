<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LicenseTypeRequest;
use App\Models\LicenseType;
use App\Repositories\LicenseTypeRepository;
use Illuminate\Http\Request;

class LicenseTypeController extends Controller
{
    protected $licenseTypeRepository;

    public function __construct(LicenseTypeRepository $licenseTypeRepository)
    {
        $this->licenseTypeRepository = $licenseTypeRepository;
    }

    public function index()
    {
        $licenseTypes = $this->licenseTypeRepository->paginate();
        return view('admin.license-types.index', compact('licenseTypes'));
    }

    public function create()
    {
        return view('admin.license-types.create');
    }

    public function store(LicenseTypeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');
        
        $this->licenseTypeRepository->create($data);
        
        return redirect()->route('admin.license-types.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(LicenseType $licenseType)
    {
        return view('admin.license-types.edit', compact('licenseType'));
    }

    public function update(LicenseTypeRequest $request, LicenseType $licenseType)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $data['is_active'] = $request->has('is_active');
        
        $this->licenseTypeRepository->update($licenseType->id, $data);
        
        return redirect()->route('admin.license-types.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(LicenseType $licenseType)
    {
        $this->licenseTypeRepository->delete($licenseType->id);
        return redirect()->route('admin.license-types.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus(LicenseType $licenseType)
    {
        $this->licenseTypeRepository->toggleStatus($licenseType->id);
        return redirect()->route('admin.license-types.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
}