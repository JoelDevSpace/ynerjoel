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

        User::factory(10)->create();

        $permissions = [
            'ADMIN.UTILISATEUR.LISTER',
            'ADMIN.UTILISATEUR.VOIR',
            'ADMIN.UTILISATEUR.CREER',
            'ADMIN.UTILISATEUR.MODIFIER',
            'ADMIN.UTILISATEUR.SUPPRIMER',
            'ADMIN.GROUPE.LISTER',
            'ADMIN.GROUPE.VOIR',
            'ADMIN.GROUPE.CREER',
            'ADMIN.GROUPE.MODIFIER',
            'ADMIN.GROUPE.SUPPRIMER',
            'ADMIN.PERMISSION.VOIR'
        ];
        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
