<?php

class GameTableSeeder extends Seeder {

    public function run()
    {
        DB::table('games')->truncate();

        $settings = array(
            array(
                'game_name'         => 'Roulette',
                'game_description'  => 'Roulette Game',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            )
        );

        DB::table('games')->insert( $settings );
    }
}