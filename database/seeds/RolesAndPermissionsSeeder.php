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
        Permission::create(['name' => 'create-finance']);
        Permission::create(['name' => 'manage-reports']);
        Permission::create(['name' => 'make-payment']);

        // create roles and assign created permissions
        // create roles and assign created permissions
        $role = Role::create(['name' => 'admin'])
              ->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'general_manager'])
            ->givePermissionTo('manage-reports', 'manage-finance', 'manage-groups', 'manage-users', 'edit-groups', 'delete-users', 'read-users', 'read-loans');

        $role = Role::create(['name' => 'branch_manager'])
            ->givePermissionTo(['create-finance', 'edit-groups', 'manage-finance', 'manage-groups', 'manage-loans', 'read-users']);

        $role = Role::create(['name' => 'cashier'])
            ->givePermissionTo(['make-payment']);

        $role = Role::create(['name' => 'loan_officer'])
            ->givePermissionTo(['manage-loans', 'manage-clients', 'manage-groups','create-loans']);

    }
}
