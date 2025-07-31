<?php

namespace App\Http\Controllers;

use App\Models\Fost;
use app\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function todo()
    {
        $countUsers = User::count();
        $countRoles = Role::count();
        $countPermissions = Permission::count();
        $countFosts = Fost::count();
        return Inertia::render('Todo', [
            'countUsers' => $countUsers,
            'countRoles' => $countRoles,
            'countPermissions' => $countPermissions,
            'countFosts' => $countFosts,
        ]);
    }


}
