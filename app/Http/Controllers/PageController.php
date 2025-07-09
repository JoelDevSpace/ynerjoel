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
        //$countUsers = User::count();
        //$countRoles = Role::count();
        return Inertia::render('Dashboard');
    }


}
