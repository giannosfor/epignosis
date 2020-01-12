<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateEmployeeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => 'Christina', 
            'lastname' => 'Gialleli', 
            'email' => 'cgialleli@epignosis.com',
            'password' => bcrypt('epignosis')

        ]);
  
        $role = Role::create(['name' => 'Employee']);

        $role->givePermissionTo('leave-list');
        $role->givePermissionTo('leave-create');
        $role->givePermissionTo('leave-edit');
        $role->givePermissionTo('leave-delete');

        $user->assignRole([$role->id]);
    }

}