<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'JoelDevSpace',
            'email' => 'joel@admin.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(25)->create();

        $role = Role::firstOrCreate([
            'name' => 'administrateur',
            'guard_name' => 'web', ]);

        $user->assignRole(1);

        $permissions = [
            'admin.utilisateur.lister',
            'admin.utilisateur.voir',
            'admin.utilisateur.creer',
            'admin.utilisateur.modifier',
            'admin.utilisateur.supprimer',
            'admin.groupe.lister',
            'admin.groupe.voir',
            'admin.groupe.creer',
            'admin.groupe.modifier',
            'admin.groupe.supprimer',
            'admin.permission.lister',
            'admin.permission.creer',
            'admin.permission.modifier',
            'admin.permission.supprimer',
            'exploit.fost.lister',
            'exploit.fost.voir',
            'exploit.fost.creer',
            'exploit.fost.modifier',
            'exploit.fost.supprimer',
            'exploit.installateur.lister',
            'exploit.installateur.voir',
            'exploit.installateur.creer',
            'exploit.installateur.modifier',
            'exploit.installateur.supprimer',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
            $role->givePermissionTo($permission);
        }
    }
}
