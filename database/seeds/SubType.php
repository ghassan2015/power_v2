<?php

use Illuminate\Database\Seeder;

class SubType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         \App\Models\Subtype::create([
            'name' => 'فاز',
            'kw_price'=>'3.3',
            'min_month_price'=>'40'
        ]);
        \App\Models\Subtype::create([
            'name' => '3 فاز',
            'kw_price'=>'4',
            'min_month_price'=>'200'
        ]);


    }
}
