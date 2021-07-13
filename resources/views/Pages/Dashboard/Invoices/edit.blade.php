@extends('Layouts.front')
@section('title','الفواتير')
@section('header','تعديل الفاتورة ')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">تسجيل فاتورة جديد</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" action="{{route('Invoices.update',$invoice->id)}}" method="POST" id="form">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row mg-b-20">

                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>قيمة العدادالحالية :</label>
                                        <select class="form-control kt_select2_2  @error('month') is-invalid @enderror"  name="month" >
                                            <option value="{{$invoice->month}}">{{$invoice->month}}</option>
                                            <option value="">كل الاشهر</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>

                                        @error('month')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>قيمة العدادالحالية :</label>
                                        <select class="form-control kt_select2_2  @error('year') is-invalid @enderror" name="year">
                                            <option value="{{$invoice->year}}"> {{$invoice->year}}</option>

                                            <option value="">السنة الحالية</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>

                                        @error('year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mg-b-20">

                                        <div class="col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">

                                            <label class="form-control-label">اسم المشترك
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control current @error('Customer') is-invalid @enderror" name="Customer" disabled

                                                   value="{{$invoice->Customer->full_name}}"/>
                                        </div>
                                        <div class="col-md-3 mg-t-20 mg-md-t-0 test" id="lnWrapper">
                                            {{--                                        <input type="hidden" value="24" class="form-control previous_read @error('previous_reading') is-invalid @enderror" name="previous_reading"/>--}}

                                            <label class="form-control-label"> القراءة الحالية
                                                <span class="text-danger">*</span></label>
                                            <input type="text" value="{{$invoice->current_reading}}" class="form-control current_reading " name="current_reading"/>
                                            <input type="hidden"  class="form-control previous_reading @error('previous_reading') is-invalid @enderror"  name="previous_reading"/>
                                            <input type="hidden"  class="form-control current_customer @error('current_customer') is-invalid @enderror" name="current_customer" value="{{$invoice->Customer->kw_meter_value}}"/>
                                            <input type="hidden" value="{{$invoice->Customer->id}}" name="customer_id">
                                            <input type="hidden" value="{{$invoice->Customer->Subtype->min_month_price}}" name="min_month_price">

                                            <input type="hidden"  class="form-control price_customer @error('price_customer') is-invalid @enderror" name="price_customer"

                                                   value="{{$invoice->Customer->kw_price}}"/>
                                            @error('current_reading')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">

                                            <label class="form-control-label"> قيمة العداد بالكيلو واط
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control total_kw @error('total_kw') is-invalid @enderror" name="total_kw" value="{{$invoice->total_kw}}" />
                                            @error('total_kw')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">

                                            <label class="form-control-label">القيمة المستحقة
                                                <span class="text-danger">*</span></label>
                                            <input type="text" value="{{$invoice->total_price}}" class="form-control total @error('Total') is-invalid @enderror" name="Total"/>
                                            @error('Total')
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
                'Total': {
                    required: true
                },
                'current_reading': {
                    required: true,
                },
                'total_kw': {
                    required: true,
                },
                errorClass: "error fail-alert",
                validClass: "valid success-alert",



            }
            ,messages : {
                'Total': {
                    required:"الرجاء ادخل الرقم"
                },
                'current_reading':  {
                    required: " الرجاء ادخل الرقم",
                },
                'total_kw':{
                    required: " الرجاء ادخل الرقم",

                }
            }
        });

    </script>


@endsection
