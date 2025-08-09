<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Agent;
use App\Models\Agency;
use App\Models\AgencyType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->role . '%'); // Used LIKE for flexibility
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->has('is_active');

        $user = User::create($data);

        $newRole = $request->role ?? null;
        if ($newRole) {
            $user->assignRole($newRole);
        }

        $this->syncRoleBasedModels($user, $newRole);

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * THIS IS THE MISSING METHOD
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = $request->has('is_active');

        $user->update($data);

        $newRole = $request->role ?? null;
        $user->syncRoles($newRole ? [$newRole] : []);

        $this->syncRoleBasedModels($user, $newRole);

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.updated_successfully'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', __('messages.cannot_delete_self'));
        }

        if ($user->agent) {
            $user->agent()->delete();
        }
        if ($user->agency) {
            $user->agency()->delete();
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    /**
     * Toggle the active status of the user.
     */
    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', __('messages.cannot_deactivate_self'));
        }

        $user->update(['is_active' => !$user->is_active]);
        return redirect()->route('admin.users.index')
            ->with('success', __('messages.status_updated_successfully'));
    }

    /**
     * A helper method to create or delete Agent/Agency records based on the user's role.
     */
    private function syncRoleBasedModels(User $user, ?string $newRoleName): void
    {
        if ($newRoleName === 'agency') {
            if (!$user->agency) {
                $defaultAgencyType = AgencyType::first();
                if (!$defaultAgencyType) { return; }
                Agency::create([
                    'user_id' => $user->id,
                    'agency_name' => $user->name,
                    'email' => $user->email,
                    'created_by' => auth()->id() ?? $user->id,
                    'agency_type_id' => $defaultAgencyType->id,
                ]);
            }
            if ($user->agent) {
                $user->agent()->delete();
            }
        } elseif ($newRoleName === 'agent') {
            if (!$user->agent) {
                Agent::create([
                    'user_id' => $user->id,
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'created_by' => auth()->id() ?? $user->id,
                    'agent_type_id' => 1, // Assumes agent_type with ID 1 exists
                ]);
            }
            if ($user->agency) {
                $user->agency()->delete();
            }
        } else {
            if ($user->agent) {
                $user->agent()->delete();
            }
            if ($user->agency) {
                $user->agency()->delete();
            }
        }
    }
}