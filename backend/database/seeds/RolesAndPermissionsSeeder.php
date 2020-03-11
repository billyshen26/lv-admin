<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class] -> forgetCachedPermissions();

        // reset db
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外键约束
        Permission::truncate();
        Role::truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 启用外键约束

        // create permission
        Permission::create(['name' => 'article']);
        Permission::create(['name' => 'article.index']);
        Permission::create(['name' => 'article.show']);
        Permission::create(['name' => 'article.store']);
        Permission::create(['name' => 'article.update']);
        Permission::create(['name' => 'article.destroy']);
        Permission::create(['name' => 'article.publish']);
        Permission::create(['name' => 'article.unpublish']);

        // create role , assign permission
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo(['article.index','article.show','article.store','article.update','article.destroy']);

        $role = Role::create(['name' => 'reader']);
        $role->givePermissionTo(['article.index','article.show']);

        // editor
        $role = Role::create(['name' => 'editor'])
            ->givePermissionTo(['article']);

        // admin
        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(['article']);

        // super admin
        $role = Role::create(['name' => 'super_admin']);
        $user = \App\User::where('name', 'super_admin')->first();
        $user->assignRole('super_admin');

        $user = \App\User::where('name', 'admin')->first();
        $user->assignRole('admin');

        $user = \App\User::where('name', 'writer')->first();
        $user->assignRole('writer');

        $user = \App\User::where('name', 'reader')->first();
        $user->assignRole('reader');

        $user = \App\User::where('name', 'editor')->first();
        $user->assignRole('editor');
    }
}
