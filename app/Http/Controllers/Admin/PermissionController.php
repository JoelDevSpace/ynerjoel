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

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(12);
        return Inertia::render('Admin/Permissions/Index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/Create', [
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
        $permission = Permission::findOrFail($id)->only('name', 'id');
        $modules = ModulesEnum::options();
        $elements = ElementsEnum::options();
        $actions = ActionsEnum::options();
        return Inertia::render('Admin/Permissions/Edit', compact('permission', 'modules', 'elements', 'actions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

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
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
