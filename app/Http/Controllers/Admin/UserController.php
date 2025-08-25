<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use App\Models\Agent;
use App\Models\AgentType; // <-- IMPORT THE AGENT TYPE MODEL
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
                $q->where('name', 'LIKE', '%' . $request->role . '%');
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

        if ($newRole === 'agent') {
            // Find a default agent type to assign
            $defaultAgentType = AgentType::where('is_active', true)->orderBy('id')->first();

            // Safety check: Make sure an agent type exists
            if (!$defaultAgentType) {
                // Manually delete the user we just created to avoid an orphaned user account
                $user->delete();
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Cannot create agent profile because no active Agent Types are configured. Please create an Agent Type first.');
            }

            Agent::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone,
                'agent_type_id' => $defaultAgentType->id, // Assign the default type ID
            ]);
        }

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
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $originalRole = $user->roles->first()?->name;
        $newRole = $request->role ?? null;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $data['is_active'] = $request->has('is_active');
        $user->update($data);

        // Logic for syncing agent profiles
        if ($newRole === 'agent' && $originalRole !== 'agent') {
            $defaultAgentType = AgentType::where('is_active', true)->orderBy('id')->first();

            if (!$defaultAgentType) {
                // Don't change the role if we can't create the agent profile
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Cannot assign agent role because no active Agent Types are configured. Please create an Agent Type first.');
            }

            Agent::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->phone,
                    'agent_type_id' => $defaultAgentType->id, // Assign the default type ID
                ]
            );
        }
        elseif ($newRole !== 'agent' && $originalRole === 'agent') {
            // Find and delete the associated agent record
            $user->agent()->delete();
        }

        // Finally, sync the role in the users table
        $user->syncRoles($newRole ? [$newRole] : []);

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

        $user->agent()->delete();
        $user->agency()->delete();

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
}