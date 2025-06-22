<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommercialRecordRequest;
use App\Repositories\CommercialRecordRepository;
use App\Repositories\AgencyRepository;
use Illuminate\Http\Request;

class CommercialRecordController extends Controller
{
    protected $commercialRecords;
    protected $agencies;

    public function __construct(CommercialRecordRepository $commercialRecords, AgencyRepository $agencies)
    {
        $this->commercialRecords = $commercialRecords;
        $this->agencies = $agencies;
    }

    public function index()
    {
        $commercialRecords = $this->commercialRecords->paginate();
        return view('admin.commercial-records.index', compact('commercialRecords'));
    }

    public function create()
    {
        $agencies = $this->agencies->all();
        return view('admin.commercial-records.create', compact('agencies'));
    }

    public function store(CommercialRecordRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = request()->user()?->id;
        $this->commercialRecords->create($data);
        return redirect()->route('admin.commercial-records.index')->with('success', __('attributes.messages.save'));
    }

    public function edit($id)
    {
        $commercialRecord = $this->commercialRecords->getWithRelations($id);
        $agencies = $this->agencies->all();
        return view('admin.commercial-records.edit', compact('commercialRecord', 'agencies'));
    }

    public function update(CommercialRecordRequest $request, $id)
    {
        $data = $request->validated();
        $data['updated_by'] = request()->user()?->id;
        $this->commercialRecords->update($id, $data);
        return redirect()->route('admin.commercial-records.index')->with('success', __('attributes.messages.save'));
    }

    public function destroy($id)
    {
        $this->commercialRecords->delete($id);
        return redirect()->route('admin.commercial-records.index')->with('success', __('attributes.messages.delete'));
    }
} 