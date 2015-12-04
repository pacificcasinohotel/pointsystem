<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('acl_user_member')->truncate();
        DB::table('acl_users')->truncate();

        $users = array(
            array(
                'username'      => 'raphael.torres',
                'fullname'      => 'Raphael Torres',
                'email'         => 'raphael@aligncommerce.com',
                'password'      => Hash::make('password123'),
                'company_name'  => 'Align Commerce',
                'last_login'    => new DateTime,
                'last_login_ip' => '127.0.0.1',
                'confirmed'     => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'return_url'    => 'http://api.aligncommerce.com/',
                'last_password_change' => new DateTime(date('Y-m-d H:i:s', strtotime("+30 days"))),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'username'      => 'pinky.torres',
                'fullname'      => 'Pinky L Torres',
                'email'         => 'user@example.org',
                'password'      => Hash::make('password123'),
                'company_name'  => 'Align Commerce',
                'last_login'    => new DateTime,
                'last_login_ip' => '127.0.0.1',
                'confirmed'     => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'return_url'    => 'http://api.aligncommerce.com/',
                'last_password_change' => new DateTime(date('Y-m-d H:i:s', strtotime("+30 days"))),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'username'      => 'michael.liwanagan',
                'fullname'      => 'Michael Liwanagan',
                'email'         => 'michael.liwanagan@gmail.com',
                'password'      => Hash::make('michael123'),
                'company_name'  => 'Align Commerce',
                'last_login'    => new DateTime,
                'last_login_ip' => '127.0.0.1',
                'confirmed'     => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'return_url'    => 'http://api.aligncommerce.com/',
                'last_password_change' => new DateTime(date('Y-m-d H:i:s', strtotime("+30 days"))),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            )
        );

        DB::table('acl_users')->insert( $users );
        
        foreach(range(1,2) as $index){
            $usermember = new UserMember;
            $usermember->user_id  = $index;
            $usermember->group_id = $index;
            $usermember->save();
        }
        
    }

}
