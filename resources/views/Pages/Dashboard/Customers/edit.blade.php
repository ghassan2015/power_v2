@extends('Layouts.front')
@section('title','المشتركين')

@section('header','تعديل بيانات المشترك')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">تعديل بيانات المشترك </h3>
                        </div>
                        <!--begin::Form-->
                        <form  id="form" class="form" action="{{route('Customers.update',$Customer->id)}}" method="POST">
                            @csrf
                                @method('PUT')
                            <div class="card-body">
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label class="form-control-label">الاسم
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{$Customer->full_name}}"/>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                    <label class="form-control-label">الايميل
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{$Customer->email}}"

                                    />
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">العنوان
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                                               value="{{$Customer->location}}"

                                        />
                                        @error('location')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">الهاتف
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                               value="{{$Customer->mobile}}"

                                        />
                                        @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">

                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">العداد
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="meter" class="form-control @error('meter') is-invalid @enderror"
                                               value="{{$Customer->meter_number}}"

                                        />
                                        @error('meter')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">القيمة الابتدائية للعداد
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('meter_value') is-invalid @enderror" name="meter_value"
                                        value="{{$Customer->kw_meter_value}}"/>
                                        @error('meter_value')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">نوع الفاز المشبوك
                                            <span class="text-danger">*</span></label>
                                        <select class="form-control kt_select2_1 @error('subtype_id') is-invalid @enderror" id="kt_select2_1" name="subtype_id">
                                            <option value="{{$Customer->Subtype->id}}">{{$Customer->Subtype->name}}</option>

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
                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{$Customer->kw_price}}"
                                        />
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">الملاحظات
                                            <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="note">{{$Customer->note}}</textarea>

                                    </div>
                            </div>
                                <div class="form-group row mg-b-20">
                                    <div class="col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label class="form-control-label">حالة المستخدم
                                            <span class="text-danger">*</span></label>
                                        <div class="col-3">
															<span class="switch switch-success">
																<label>
																	<input type="checkbox"  name="status"
                                                                           @if($Customer -> status == 1)checked @endif
                                                                           value="1"/>
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
console.log('aswas'+value['value']);
                            $('input[name="price"]').val(value['value']);


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
                    required: true
                },
                'email': {ا
                    required: true,
                },

                'phone':{
                    required: true,

                },
                'meter':{
                    required: true,

                },
                'meter_value':{
                    required: true,

                },
                'subtype_id':{
                    required: true,

                },
                'price':{
                    required: true,

                },
                'location':{
                    required: true,

                },
                errorClass: "error fail-alert",
                validClass: "valid success-alert",



            }
            ,messages : {
                'Total[]': {
                    required:"الرجاء ادخل الرقم"
                },
                'current_reading[]':  {
                    required: " الرجاء ادخل الرقم",
                },
            }
        });

    });
</script>
@stop
