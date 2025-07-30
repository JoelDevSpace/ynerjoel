<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'JoelDevSpace',
            'email' => 'joel@admin.com',
            'password' => Hash::make('password'),
        ]);

        User::factory(25)->create();

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
        ];
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
