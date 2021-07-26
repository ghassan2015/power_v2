@extends('Layouts.front')
@section('title','الاعدادات')
@section('header','الاعدادات -تعديل')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">الاعدادات</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" action="{{route('Settings.Update','test')}}" method="POST" id="form">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row mg-b-20">

                                        <div class="col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                            <input type="hidden" class="form-control current @error('id') is-invalid @enderror" name="id" value="{{$Setting->id}}"/>

                                            <label class="form-control-label">URL
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control current @error('url') is-invalid @enderror" name="url" value="{{$Setting->url}}"/>
                                        </div>
                                        <div class="col-md-4 mg-t-20 mg-md-t-0 test" id="lnWrapper">
                                            <label class="form-control-label"> SmsTo
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control current @error('sms_to') is-invalid @enderror" name="sms_to" value="{{$Setting->sms_to}}"/>
                                            @error('sms_to')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">

                                            <label class="form-control-label">Message
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control total_kw @error('message') is-invalid @enderror" name="message" value="{{$Setting->message}}"/>
                                            @error('message')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>



                                </div>

                                <div class="card-footer" style="text-align: end">
                                    <button type="submit" class="btn btn-success font-weight-bold mr-2"><span>تاكيد</span> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
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

            $('.current').on('change', function () {

                var current_reading = $(this).val();

                //     console.log('customer_id'+customer_id);
                var this_item = $(this);
                var previous_reading='';
                var Customer_id = $(this).val();
                var previous_reading_customer=$('.previous_reading_customer').val();
                if (Customer_id) {
                    $.ajax({
                        url: "{{ URL::to('Dashboard/Invoices/Customer') }}/" + Customer_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            //    console.log(data);
                            $('input[name="previous_reading"]').empty();
                            $.each(data, function (key, value) {
                                // console.log('curernt_name'+value.current_reading);
                                previous_reading= this_item.parent().next().find('.previous_reading').val(value.current_reading);

                            });
                        },
                    });
                }
                setTimeout(function() {
                    previous_reading= this_item.parent().next().find('.previous_reading').val();
                },500);



            });

            $('.current_reading').on('change', function () {

                var current_reading_value = $(this).val();

                //     console.log('customer_id'+customer_id);
                var this_item = $(this);

                var previous_reading='';
                var Customer_id = $(this).next().next().next().val();
                //   console.log(Customer_id);
                var previous_reading_customer=$('.previous_reading_customer').val();
                if (Customer_id) {
                    $.ajax({
                        url: "{{ URL::to('Dashboard/Invoices/Customer') }}/" + Customer_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            //      console.log(data);
                            $('input[name="previous_reading"]').empty();
                            $.each(data, function (key, value) {
                                // console.log('curernt_name'+value.current_reading);
                                previous_reading= this_item.next().val(value.current_reading);

                            });
                        },
                    });
                }
                var previous_reading_value=0;

                setTimeout(function () {
                    if( typeof previous_reading === 'undefined' || previous_reading=== '' ){
                        previous_reading_value= this_item.next().next().val();

                    }else{
                        previous_reading_value= previous_reading.val();

                    }
                    var sub_reading=Math.abs(Number(current_reading_value-previous_reading_value));
                    this_item.parent().next().find('.total_kw').val(sub_reading);

                    var price= this_item.next().next().next().next().val();
                    var min_month_price =this_item.next().next().next().next().val();

                    var Total=Number(price*sub_reading);

                    if( Total>min_month_price) {


                        this_item.parent().next().next().find('.total').val(Total);

                    }else{
                        this_item.parent().next().next().find('.total').val(min_month_price);

                    }
                },500);




                //var price= this_item.next().next().val();





            });

        });
        $('#form').validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            // initialize the plugin
            rules: {
                'Total[]': {
                    required: true
                },
                'current_reading[]': {
                    required: true,
                },
                'total_kw[]': {
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
                'total_kw[]':{
                    required: " الرجاء ادخل الرقم",

                }
            }
        });

    </script>


@endsection
