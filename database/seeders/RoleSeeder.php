<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
            ],
        ]);
    }
}
