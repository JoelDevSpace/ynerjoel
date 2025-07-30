<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Admin\ActionsEnum;
use App\Enums\Admin\ElementsEnum;
use App\Enums\Admin\ModulesEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Admin\Permission\PermissionCreateRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('admin.permission.lister'), 403, '403 Forbidden');

        $permissions = Permission::where('name', 'like', '%' . $request->search . '%')
            ->paginate(12);
        $request->filled('search') ? $searchTerm = request(['search'])['search'] : $searchTerm = "";
        return Inertia::render('admin/permissions/index', compact('permissions', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('admin.permission.creer'), 403, '403 Forbidden');

        return Inertia::render('admin/permissions/create', [
            'modules' => ModulesEnum::options(),
            'elements' => ElementsEnum::options(),
            'actions' => ActionsEnum::options()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionCreateRequest $request)
    {
        abort_if(Gate::denies('admin.permission.creer'), 403, '403 Forbidden');

        $permission = Permission::create([
            'name' => implode(".", [$request->module, $request->element, $request->action]),
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(Gate::denies('admin.permission.modifier'), 403, '403 Forbidden');

        $permission = Permission::findOrFail($id)->only('name', 'id');
        $modules = ModulesEnum::options();
        $elements = ElementsEnum::options();
        $actions = ActionsEnum::options();
        return Inertia::render('admin/permissions/edit', compact('permission', 'modules', 'elements', 'actions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $request, string $id)
    {
        abort_if(Gate::denies('admin.permission.modifier'), 403, '403 Forbidden');

        $permission = Permission::findOrFail($id);
        $permission->name = implode(".", [$request->module, $request->element, $request->action]);
        $permission->save();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission mise à jour avec succès.');
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(Gate::denies('admin.permission.supprimer'), 403, '403 Forbidden');

        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
