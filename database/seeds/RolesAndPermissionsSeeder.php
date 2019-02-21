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
         Permission::create(['name' => 'manage roles']);
         Permission::create(['name' => 'manage users']);
         Permission::create(['name' => 'manage loans']);
         Permission::create(['name' => 'read loans']);
         Permission::create(['name' => 'create loans']);
         Permission::create(['name' => 'manage clients']);
         Permission::create(['name' => 'manage groups']);
         Permission::create(['name' => 'read groups']);
         Permission::create(['name' => 'create groups']);
         Permission::create(['name' => 'create clients']);
         Permission::create(['name' => 'read clients']);
         Permission::create(['name' => 'manage options']);
         Permission::create(['name' => 'read options']);
         Permission::create(['name' => 'create options']);

         // create roles and assign created permissions

         // this can be done as separate statements
         $role = Role::create(['name' => 'admin']);
         $role->givePermissionTo(Permission::all());


         $role = Role::create(['name' => 'loan_manager'])
             ->givePermissionTo(['manage loans', 'read clients', 'read groups']);

         $role = Role::create(['name' => 'client_manager'])
             ->givePermissionTo(['manage loans', 'manage clients', 'manage groups']);

         $role = Role::create(['name' => 'general_manager'])
             ->givePermissionTo(['read loans', 'read clients', 'read groups', 'manage options']);
     }
}
