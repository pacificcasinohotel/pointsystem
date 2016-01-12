<?php

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->truncate();

        $settings = array(
            array(
                'name'         => 'password_expiry',
                'display_name' => 'Password Expiry',
                'value'        => '30',
                'type'         => 'configurable',
                'created_at'   => new DateTime,
                'updated_at'   => new DateTime,
            ),
            array(
                'name'         => 'points_conversion',
                'display_name' => 'Points Conversion',
                'value'        => '50',
                'type'         => 'configurable',
                'created_at'   => new DateTime,
                'updated_at'   => new DateTime,
            )
        );

        DB::table('settings')->insert( $settings );
    }
}