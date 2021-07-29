@extends('Layouts.front')
@section('title','المشتركين')
@section('header','اضافة مشترك جديد')
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title"> مشترك جديد</h3>

                        </div>
                        <!--begin::Form-->
                        <form  id="form"class="form" action="{{route('Customers.Store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label class="form-control-label">الاسم
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" />
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                    <label class="form-control-label">الايميل
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" />
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">كلمة المرور
                                            <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"/>
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">تاكيد كلمة المرور
                                            <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" />
                                        @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">العنوان
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" />
                                        @error('location')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">الهاتف
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"/>
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">

                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">
                                            رقم العداد
                                        </label>
                                        <input type="text" name="meter" class="form-control @error('meter') is-invalid @enderror" />
                                        @error('meter')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">القيمة الابتدائية للعداد (kw)
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('meter_value') is-invalid @enderror"  value="0" name="meter_value" />
                                        @error('meter_value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">نوع الفاز المشبوك
                                            <span class="text-danger">*</span></label>
                                        <select class="form-control kt_select2_1"name="subtype_id">
                                            <option style="direction:">ادخل نوع الاشتراك </option>

                                            @foreach($Sub_types as $Sub_type)
                                                <option value="{{$Sub_type->id}}">{{$Sub_type->name}}</option>
                                            @endforeach

                                        </select>
                                        @error('subtype_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">سعر الكيلو
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"/>
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">الملاحظات
                                         </label>
                                        <textarea class="form-control" name="note"></textarea>

                                    </div>
                            </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">حالة المستخدم
                                            <span class="text-danger">*</span></label>
                                        <div class="col-3">
															<span class="switch switch-success">
																<label>
																	<input type="checkbox" checked="checked" name="status"  value="1"/>
																	<span></span>
																</label>
															</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="text-align: end">
                                <button type="submit" class="btn btn-success font-weight-bold mr-2"><span>تاكيد</span> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                <a href="{{route('Customers.index')}}" class="btn btn-danger font-weight-bold mr-2"><span>رجوع للخلف
                                     </span><i class="fas fa-backward"></i></a>

                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->

            </div>
        </div>
        <!--end::Container-->
    </div>
    </div>
@stop
@section('js')

<script>
    $(document).ready(function () {

        $('#email').on('change', function () {
            var email=$(this).val();
            if (email) {
                $.ajax({
                    url: "{{ URL::to('Dashboard/Customers/email') }}/" + email,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {

                        $('input[name="price"]').empty();
                        $.each(data, function (key, value) {
                            $('#email').val('');
                         if(value['email']){
                             Swal.fire(
                                 {
                                     title: "هذا الايميل مستخدم",
                                     text: "الرجاء استخدام ايميل اخر ",
                                     icon: "warning",
                                     buttons: true,
                                     dangerMode: true,
                                 })
                                 .then((willDelete) => {
                                     if (willDelete) {
                                         swal("Poof! Your imaginary file has been deleted!", {
                                             icon: "success",
                                         });
                                     } else {
                                         swal("Your imaginary file is safe!");
                                     }
                                 });

                         }



                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }

        });
            $('select[name="subtype_id"]').on('change', function () {

            var counter_id = $(this).val();

            if (counter_id) {
                $.ajax({
                    url: "{{ URL::to('Dashboard/Customers/Subtype') }}/" + counter_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('input[name="price"]').empty();
                        $.each(data, function (key, value) {
                            // $('select[name="counter_id"]').append('<option value="' +
                            //     key + '">' + value + '</option>');
                            $('input[name="price"]').val(value['kw_price']);


                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
        $('#form').validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            // initialize the plugin
            rules: {
                'name': {
                    required: true,
                    minlength: 3,

                },
                'email': {
                    required: true,
                    email: true,

                },
                'password': {
                    required: true,
                },
                'phone':{
                    number:true,
                    required: true,
                    minlength: 10,

                },
                // 'meter':{
                //
                //     required: true,
                //
                // },
                'meter_value':{
                    number:true,
                    required: true,

                },
                'subtype_id':{
                    required: true,

                },
                'location':{
                    required: true,

                },
                'price':{
                    required: true,
                    number:true,
                },
                errorClass: "error fail-alert",
                validClass: "valid success-alert",



            }
            ,messages : {
                'name': {
                    required:"الرجاءاسم المشترك",
                    minlength: 'الرجاء كتابة الاسم صحيحة',

                },
                'email':  {
                    required: " الرجاء الايميل المشترك",
                    email:'الرجاء ادخل الايميل بطريقة صحيحة',

                },
                'location':{
                    required: " الرجاء عنوان المشترك ",
                },
                'phone':{
                    required: " الرجاء هاتف المشترك ",
                    minlength:'الرجاء ادخل 10 ارقام ',
                    number:'الرجاء ادخال رقم صحيح'
                },
                'price':{
                    required: "الرجاء ادخال قيمة الكيلو الواحد",
                    number:'الرجاء ادخال رقم صحيح'
                },
                // 'meter':{
                //     required: 'الرجاء ادخل رقم العداد',
                //
                // },
                'meter_value':{
                    required: 'الرجاء ادخل القيمة الابتدائية للعداد',
                    number:'الرجاء ادخال رقم صحيح'

                },
                'subtype_id':{
                    required: 'الرجاءادخل نوع الاشتراك',

                },


            }
        });
    });
</script>
@stop
