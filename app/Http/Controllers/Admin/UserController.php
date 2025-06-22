<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->has('is_active');

        $user = User::create($data);

        if ($request->filled('role')) {
            $user->assignRole($request->role);
        }

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.created_successfully'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

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

        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        } else {
            // If no role is selected, remove all roles
            $user->syncRoles([]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', __('messages.updated_successfully'));
    }

    public function destroy(User $user)
    {
        // Optional: Prevent users from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', __('messages.cannot_delete_self'));
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', __('messages.deleted_successfully'));
    }

    public function toggleStatus(User $user)
    {
        // Optional: Prevent users from deactivating themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', __('messages.cannot_deactivate_self'));
        }
        
        $user->update(['is_active' => !$user->is_active]);
        return redirect()->route('admin.users.index')
            ->with('success', __('messages.status_updated_successfully'));
    }
}