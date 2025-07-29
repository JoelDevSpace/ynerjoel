<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): response
    {
        $request->filled('search') ? $searchTerm = request(['search'])['search'] : $searchTerm = "";

        $users = User::with('roles')
            ->search($request)
            ->paginate(12);

        return Inertia::render('Admin/Users/Index', compact('users', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): response
    {
        $roles = Role::all()->select(['id', 'name']);
        return Inertia::render('Admin/Users/Create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->input('role', []));
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $userRole = $user->roles->select(['id', 'name']);
        $roles = Role::all()->select(['id', 'name']);
        return Inertia::render('Admin/Users/Edit', compact('user', 'userRole', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $request->validate(['password' => 'required|string|min:8']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles($request->input('role', []));

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
