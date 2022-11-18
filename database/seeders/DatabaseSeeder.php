<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('roles')->truncate();
        DB::table('users')->truncate();

        $roles = ['Admin', 'Employee'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        User::factory()->create([
            'nip' => '11111',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'nip' => '22222',
            'role_id' => 2,
        ]);
    }
}
