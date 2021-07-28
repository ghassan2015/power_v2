@extends('layouts.front')
@section('title','تغير كلمة المرور')
@section('content')
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">تغير كلمة مرور</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">تغير كلمة مرور حسابي الشخصي</span>
                </div>
            </div>
                <form id="from_validate" class="from_validate" action="{{route('User.change.password')}}" method="post">
                    @csrf


            <!--begin::Form-->

            <div class="card-body">
                <!--begin::Alert-->
                <!--end::Alert-->
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">كلمة مرور الحالية</label>

                <div class="form-group row">
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="current_password"
                               class="form-control form-control-lg form-control-solid mb-2" value=""
                               placeholder="كلمة المرور الحالية"/>
                    </div>
                    @error('current_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">كلمة مرور الجديدة</label>

                <div class="form-group row">
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="new_password" id="password"
                               class="form-control form-control-lg form-control-solid" value=""
                               placeholder="كلمة المرور الجديدة"/>
                    </div>
                    @error('new_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <label class="col-xl-3 col-lg-3 col-form-label text-alert">تاكيد كلمة المرور</label>

                <div class="form-group row">
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="new_confirm_password"
                               class="form-control form-control-lg form-control-solid" value=""
                               placeholder="تاكيد كلمة المرور"/>
                    </div>
                    @error('new_confirm_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
                        <div class="card-footer" style="text-align: end">
                            <button type="submit" class="btn btn-success font-weight-bold mr-2"><span>تاكيد</span> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            <a href="{{route('Dashboard.index')}}" class="btn btn-danger font-weight-bold mr-2 backward"><span>تراجع</span> <i class="fas fa-backspace"></i></a>

                        </div>

                </form>
            <!--end::Form-->
        </div>
    </div>

@stop
@section('js')
    <script>
        $(document).ready(function () {
            $('#from_validate').validate({
                errorClass: "error fail-alert",
                validClass: "valid success-alert",
                // initialize the plugin
                rules: {
                    current_password: {
                        required:true,
                        minlength: 5
                    }

                },
                new_password: {
                    required:true,

                    minlength: 5
                },
                new_confirm_password: {
                    required:true,
                    minlength: 5,
                    equalTo: "#password"
                    ,


                    errorClass: "error fail-alert",
                    validClass: "valid success-alert",
                }
                , messages: {
                    'current_password': {
                        required: "الرجاء ادخال الاسم",
                        minlength:'الرجاءادخال على الاقل 5حروف او ارقام'
                    },
                    'new_password': {
                        required: "الرجاء ادخال الاسم",
                        minlength:'الرجاءادخال على الاقل 5حروف او ارقام'
                    },
                    'new_confirm_password': {
                        required: "الرجاء ادخال الاسم",
                        minlength:'الرجاءادخال على الاقل 5حروف او ارقام'
                        equalTo:'كلمة المرور غير مطابقة'
                    },


                },
                'attributes':{
                'current_password':'كلمة المرور الحالية',
                'password':'كلمة المرور'
        },
            });
        });
    </script>
@endsection
