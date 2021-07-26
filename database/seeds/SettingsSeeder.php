<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\SmsMessageSettings::create([
            'url' => 'https://github.com/',
            'sms_to'=>'972567711720',
            'message'=>'تمت عملية الاضافة بنجاح'
        ]);
    }
}
