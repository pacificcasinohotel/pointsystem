<?php

class PayoutSeeder extends Seeder {

    public function run()
    {
        DB::table('game_payouts')->truncate();

        $settings = array(
            array(
                'bet'           => 'Single Number',
                'name'          => 'straight',
                'payout'        => '35',
                'percentage'    => '2.63',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => '2 Number',
                'name'          => 'split',
                'payout'        => '17',
                'percentage'    => '5.26',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => '3 Number',
                'name'          => 'line',
                'payout'        => '11',
                'percentage'    => '7.89',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => '4 Number',
                'name'          => 'square',
                'payout'        => '8',
                'percentage'    => '10.53',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => '5 Number',
                'name'          => 'basket',
                'payout'        => '6',
                'percentage'    => '13.16',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => '6 Number',
                'name'          => 'doublestreet',
                'payout'        => '5',
                'percentage'    => '15.79',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'Column',
                'name'          => '1stcolumn',
                'payout'        => '2',
                'percentage'    => '31.58',
                'numbers_covered'=> '1,4,7,10,13,16,19,22,25,28,31,34',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'Column',
                'name'          => '2ndcolumn',
                'payout'        => '2',
                'percentage'    => '31.58',
                'numbers_covered'=> '2,5,8,11,14,17,20,23,26,29,32,35',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'Column',
                'name'          => '3rdcolumn',
                'payout'        => '2',
                'percentage'    => '31.58',
                'numbers_covered'=> '3,6,9,12,15,18,21,24,27,30,33,36',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'Dozen',
                'name'          => '1dozen',
                'payout'        => '2',
                'percentage'    => '31.58',
                'numbers_covered'=> '1,2,3,4,5,6,7,8,9,10,12',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'            => 'Dozen',
                'name'           => '2dozen',
                'payout'         => '2',
                'percentage'     => '31.58',
                'numbers_covered'=> '13,14,15,16,17,18,19,20,21,22,23,24',
                'created_at'     => new DateTime,
                'updated_at'     => new DateTime            
            ),
            array(
                'bet'            => 'Dozen',
                'name'           => '3dozen',
                'payout'         => '2',
                'percentage'     => '31.58',
                'numbers_covered'=> '25,26,27,28,29,30,31,32,33,34,35,36',
                'created_at'     => new DateTime,
                'updated_at'     => new DateTime            
            ),
            array(
                'bet'           => 'HighLow',
                'name'          => 'low',
                'payout'        => '1',
                'percentage'    => '47.37',
                'numbers_covered'=> '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'HighLow',
                'name'          => 'high',
                'payout'        => '1',
                'percentage'    => '47.37',
                'numbers_covered'=> '19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'Odd',
                'name'          => 'odd',
                'payout'        => '1',
                'percentage'    => '47.37',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'Even',
                'name'          => 'even',
                'payout'        => '1',
                'percentage'    => '47.37',
                'numbers_covered' => '',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'RedBlack',
                'name'          => 'red',
                'payout'        => '1',
                'percentage'    => '47.37',
                'numbers_covered'=> '1,3,5,7,9,12,14,16,18,19,21,23,25,27,30,32,34,36',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            ),
            array(
                'bet'           => 'RedBlack',
                'name'          => 'black',
                'payout'        => '1',
                'percentage'    => '47.37',
                'numbers_covered'=> '2,4,6,8,10,11,13,15,17,20,22,24,26,28,29,31,33,35',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime            
            )
        );

        DB::table('game_payouts')->insert( $settings );

    }
}