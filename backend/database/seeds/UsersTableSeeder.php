<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset db
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外键约束
        \App\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 启用外键约束

        $password = \Illuminate\Support\Facades\Hash::make('password');

        \App\User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@test.com',
            'password' => $password
        ]);
        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => $password
        ]);
        \App\User::create([
            'name' => 'editor',
            'email' => 'editor@test.com',
            'password' => $password
        ]);
        \App\User::create([
            'name' => 'writer',
            'email' => 'writer@test.com',
            'password' => $password
        ]);
        \App\User::create([
            'name' => 'reader',
            'email' => 'reader@test.com',
            'password' => $password
        ]);

    }
}
