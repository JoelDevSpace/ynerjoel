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
        $permissions = Permission::paginate(15);
        return Inertia::render('Admin/Permissions/Index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Permissions/Create', ['modules' => ModulesEnum::options(), 'elements' => ElementsEnum::options(), 'actions' => ActionsEnum::options()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionCreateRequest $request)
    {
        $permission = Permission::create([
            'name' => implode(".", [$request->module, $request->element, $request->action]),
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
