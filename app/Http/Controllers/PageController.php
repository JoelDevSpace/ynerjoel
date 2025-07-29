<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use app\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }
    public function admin()
    {
        $countUsers = User::count();
        $countRoles = Role::count();
        $countPermissions = Permission::count();
        return Inertia::render('admin/Admin', [
            'countUsers' => $countUsers,
            'countRoles' => $countRoles,
            'countPermissions' => $countPermissions,
        ]);
    }


}
