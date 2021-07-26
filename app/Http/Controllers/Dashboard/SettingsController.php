<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmsRequest;
use App\SmsMessageSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(){
        $Setting=SmsMessageSettings::first();
    return view('Pages.Dashboard.Settings.sms',compact('Setting'));
    }
    public function update(SmsRequest $request){

        try {

         $smsmessagesrttings=     SmsMessageSettings::find($request->id);
          $smsmessagesrttings->url=$request->url;
          $smsmessagesrttings->sms_to=$request->sms_to;
          $smsmessagesrttings->message=$request->message;
          $smsmessagesrttings->save();
        toastr()->success('تمت عمليةالتعديل بنجاح');
        return redirect()->route('Settings.edit');

    } catch (\Exception $e) {
            return $e;
toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
return redirect()->route('Settings.edit');

}

    }
}
