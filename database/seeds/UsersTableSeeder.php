<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();
        
        $adminRoles = Roles::where('name', 'admin')->first();
        $managerRoles = Roles::where('name', 'manager')->first();
        $userRoles = Roles::where('name', 'customer')->first();

        $admin = Admin::create([
            'admin_name' => 'Admin',
            'admin_phone' => '0147852369',
            'admin_email' => 'admin@gmail.com',
            'admin_password' => md5('123456')
        ]);
        $manager = Admin::create([
            'admin_name' => 'Manager',
            'admin_phone' => '0147852369',
            'admin_email' => 'manager@gmail.com',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'User',
            'admin_phone' => '0147852369',
            'admin_email' => 'user@gmail.com',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $manager->roles()->attach($managerRoles);
        $user->roles()->attach($userRoles);

        factory(App\Admin::class, 20)->create();
    }
}