<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InitialPermissionsSeeder extends Seeder
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
        Permission::create([
            'name' => 'viewUserNavBtn',
            'display_name' => 'View Side Navigation Button User',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'sideNav'
        ]);
        Permission::create([
            'name' => 'viewUsersNavSubBtn',
            'display_name' => 'View Side Navigation Sub Button Users',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'sideNav'
        ]);
        Permission::create([
            'name' => 'viewPermissionsNavSubBtn',
            'display_name' => 'View Side Navigation Sub Button Permissions',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'sideNav'
        ]);
        Permission::create([
            'name' => 'viewEmployeeNavBtn',
            'display_name' => 'View Employee Side Navigation Button',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'sideNav'
        ]);      
        Permission::create([
            'name' => 'viewEmployeesNavSubBtn',
            'display_name' => 'View Side Navigation Sub Button Employees',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'sideNav'
        ]);
        Permission::create([
            'name' => 'viewNotificationIcon',
            'display_name' => 'View Notification Icon',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'topNav'
        ]);
        Permission::create([
            'name' => 'viewSearchBar',
            'display_name' => 'View Search Icon',
            'module' => 'layouts',
            'category' => 'dashboard',
            'sub_category' => 'topNav'
        ]);


        Permission::create([
            'name' => 'addEmployee',
            'display_name' => 'Add Employee',
            'module' => 'hr',
            'category' => 'employee',
            'sub_category' => 'employeeMgt'
        ]);
        Permission::create([
            'name' => 'deleteEmployee',
            'display_name' => 'Delete Employee',
            'module' => 'hr',
            'category' => 'employee',
            'sub_category' => 'employeeMgt'
        ]);
        Permission::create([
            'name' => 'viewEmployees',
            'display_name' => 'View Employees',
            'module' => 'hr',
            'category' => 'employee',
            'sub_category' => 'employeeMgt'
        ]);
        Permission::create([
            'name' => 'viewEmployee',
            'display_name' => 'View Employee',
            'module' => 'hr',
            'category' => 'employee',
            'sub_category' => 'employeeMgt'
        ]);
        Permission::create([
            'name' => 'updateEmployee',
            'display_name' => 'Update Employee',
            'module' => 'hr',
            'category' => 'employee',
            'sub_category' => 'employeeMgt'
        ]);


        Permission::create([
            'name' => 'addUser',
            'display_name' => 'Add User',
            'module' => 'admin',
            'category' => 'user',
            'sub_category' => 'userMgt'
        ]);
        Permission::create([
            'name' => 'deleteUser',
            'display_name' => 'Delete User',
            'module' => 'admin',
            'category' => 'user',
            'sub_category' => 'userMgt'
        ]);
        Permission::create([
            'name' => 'viewUsers',
            'display_name' => 'View Users',
            'module' => 'admin',
            'category' => 'user',
            'sub_category' => 'userMgt'
        ]);
        Permission::create([
            'name' => 'viewUser',
            'display_name' => 'View User',
            'module' => 'admin',
            'category' => 'user',
            'sub_category' => 'userMgt'
        ]);
        Permission::create([
            'name' => 'updateUser',
            'display_name' => 'Update User',
            'module' => 'admin',
            'category' => 'user',
            'sub_category' => 'userMgt'
        ]);

        // this can be done as separate statements
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');

        // // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        //     ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
