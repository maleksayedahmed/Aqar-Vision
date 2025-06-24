<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate(10);
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(PlanRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();
        Plan::create($data);
        return redirect()->route('admin.plans.index')->with('success', __('messages.created_successfully'));
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(PlanRequest $request, Plan $plan)
    {
        $data = $request->validated();
        $data['updated_by'] = auth()->id();
        $plan->update($data);
        return redirect()->route('admin.plans.index')->with('success', __('messages.updated_successfully'));
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', __('messages.deleted_successfully'));
    }
}
