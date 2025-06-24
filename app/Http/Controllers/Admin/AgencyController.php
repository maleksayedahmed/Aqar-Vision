<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgencyRequest;
use App\Models\Agency;
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

    public function edit(Agency $agency)
    {
        $agency->load('user', 'agencyType');
        $users = $this->userRepository->all();
        $agencyTypes = $this->agencyTypeRepository->getActive();
        return view('admin.agencies.edit', compact('agency', 'users', 'agencyTypes'));
    }

    public function update(AgencyRequest $request, Agency $agency)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();

        $this->agencyRepository->update($agency->id, $data);

        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Agency $agency)
    {
        $this->agencyRepository->delete($agency->id);
        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function updateAccreditationStatus(Request $request, $id)
    {
        $agency = $this->agencyRepository->find($id);

        $accreditedStatus    = ['en' => 'Accredited', 'ar' => 'معتمد'];
        $notAccreditedStatus = ['en' => 'Not Accredited', 'ar' => 'غير معتمد'];

        if ($agency->getTranslation('accreditation_status', 'en') === 'Accredited') {
            $newStatus = $notAccreditedStatus;
        } else {
            $newStatus = $accreditedStatus;
        }

        $this->agencyRepository->update($id, ['accreditation_status' => $newStatus]);

        return redirect()->route('admin.agencies.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
}
