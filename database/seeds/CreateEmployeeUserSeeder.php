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
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }

}