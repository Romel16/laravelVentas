<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

       /*  $administrador= Role::create(['name'=>'ADMINISTRADOR']); */

        Producto::factory()->count(100)->create();
    }
}
