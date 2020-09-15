<?php

use Illuminate\Database\Seeder;
// use Sentinel;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
                'name'          => 'Admin',
                'first_name'    => 'Admin',
                'last_name'     => 'AndIt',
                'email'         => 'admin@andit.com',
                'password'      => '123456', //123456
                'created_at'    => now(),
                'updated_at'    => now()
        ];
        $user = \Sentinel::registerAndActivate($users);
        $role = \Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user->id);

        
        $users = [
                'name'          => 'Gopal Singh Dhanik',
                'first_name'    => 'Gopal',
                'last_name'     => 'Singh Dhanik',
                'email'         => 'drgopal@andit.com',
                'password'      => '123456', //123456
                'created_at'    => now(),
                'updated_at'    => now()
        ];
        $user = \Sentinel::registerAndActivate($users);
        $role = \Sentinel::findRoleBySlug('doctor');
        $role->users()->attach($user->id);

        $users = [
                'name'          => 'Vivek Saxena',
                'first_name'    => 'Vivek',
                'last_name'     => 'Saxena',
                'email'         => 'saxena@andit.com',
                'password'      => '123456', //123456
                'created_at'    => now(),
                'updated_at'    => now()
        ];
        $user = \Sentinel::registerAndActivate($users);
        $role = \Sentinel::findRoleBySlug('doctor');
        $role->users()->attach($user->id);

        $users = [
                'name'          => 'Dr. Alok Bajpai',
                'first_name'    => 'Alok',
                'last_name'     => 'Bajpai',
                'email'         => 'alok@andit.com',
                'password'      => '123456', //123456
                'created_at'    => now(),
                'updated_at'    => now()
        ];
        $user = \Sentinel::registerAndActivate($users);
        $role = \Sentinel::findRoleBySlug('doctor');
        $role->users()->attach($user->id);
    }
}
