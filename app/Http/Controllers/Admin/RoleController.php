<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleCreateRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        abort_if(Gate::denies('admin.groupe.lister'), 403, '403 Forbidden');

        $roles = Role::with("permissions")->get();
        return Inertia::render('admin/roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('admin.groupe.creer'), 403, '403 Forbidden');

        $permissions = Permission::all()->pluck('name', 'id');
        return Inertia::render('admin/roles/create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleCreateRequest $request)
    {
        abort_if(Gate::denies('admin.groupe.creer'), 403, '403 Forbidden');

        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Groupe utilisateur ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): Response
    {
        abort_if(Gate::denies('admin.groupe.modifier'), 403, '403 Forbidden');

        $rolePermissions = $role->permissions->pluck('name');
        $permissions = Permission::all()->pluck('name', 'id');
        return Inertia::render('admin/roles/edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        abort_if(Gate::denies('admin.groupe.modifier'), 403, '403 Forbidden');

        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Groupe utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies('admin.groupe.supprimer'), 403, '403 Forbidden');

        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Groupe utilisateur supprimé avec succès.');
    }
}
