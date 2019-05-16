<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage-roles']);
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'read-users']);
        Permission::create(['name' => 'manage-loans']);
        Permission::create(['name' => 'read-loans']);
        Permission::create(['name' => 'create-loans']);
        Permission::create(['name' => 'manage-clients']);
        Permission::create(['name' => 'manage-groups']);
        Permission::create(['name' => 'read-groups']);
        Permission::create(['name' => 'create-groups']);
        Permission::create(['name' => 'edit-groups']);
        Permission::create(['name' => 'create-clients']);
        Permission::create(['name' => 'read-clients']);
        Permission::create(['name' => 'manage-options']);
        Permission::create(['name' => 'read-options']);
        Permission::create(['name' => 'create-options']);
        Permission::create(['name' => 'manage-finance']);
        Permission::create(['name' => 'manage-reports']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'general_manager'])
            ->givePermissionTo('manage-reports');

        $role = Role::create(['name' => 'branch_manager'])
            ->givePermissionTo(['manage-clients', 'manage-finance','edit-groups', 'manage-groups', 'manage-users', 'manage-loans', 'read-users']);

        $role = Role::create(['name' => 'loan_officer'])
            ->givePermissionTo(['manage-loans', 'manage-clients', 'manage-groups']);
    }
}
