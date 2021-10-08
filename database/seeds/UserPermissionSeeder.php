<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create_job_vacancy']);
        Permission::create(['name' => 'show_job_vacancy']);
        Permission::create(['name' => 'edit_job_vacancy']);
        Permission::create(['name' => 'delete_job_vacancy']);

        $role_admin= Role::create(['name' => 'administrator']);

        Permission::create(['name' => 'apply_job_vacancy']);
        $general = Role::create(['name' => 'general']);
        $general->givePermissionTo('apply_job_vacancy');

        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'administrator@email.com',
            'password' => bcrypt('secret'),
        ]);
        

        $user = User::create([
            'name' => 'Alliq Nur Imanin Aji',
            'email' => 'alliq@email.com',            
            'password' => bcrypt('secret'),
        ]);

        $users = User::get();
        foreach ($users as $u) {
            $u->assignRole($general);
        }
        $admin->assignRole($role_admin);
    }
}
