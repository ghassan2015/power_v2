@extends('Layouts.front')
@section('title','الفواتير')
@section('header','اضافة فاتورة جديد')

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
                        </div>
                        <!--begin::Form-->

                        <form class="form" action="{{route('Invoices.create')}}" method="get">
                            @csrf

                            <div class="card-body">
                                <div class="form-group row mg-b-20 form_search">

                                    <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                        <label>الشهر  :</label>
                                        <span class="text-danger">*</span>

                                        <select class="form-control kt_select2_2 month  @error('month') is-invalid @enderror"  name="month">
                                            @if(!is_null($month))
                                                <option value="{{is_null($month)?'':$month}}">{{is_null($month)?'':$month}}</option>
                                            @endif
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
                                        <label>السنة :</label>
                                        <span class="text-danger">*</span>

                                        <select class="form-control kt_select2_2  @error('year') is-invalid @enderror" name="year">
                                            @if(!is_null($year))
                                                <option value="{{is_null($year)?'':$year}}">{{is_null($year)?'':$year}}</option>
                                            @endif
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
                                <button type="submit" class="btn btn-success font-weight-bold mr-2 submit form_search"><span>تاكيد</span> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>

                        </form>
                        @if(!is_null($Customers))

                        <form class="form " action="{{route('Invoices.store')}}" method="post">
                            @csrf
                            <div class="form-group row mg-b-20 form_Date">

                                <div class="col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                    <label>الشهر  :</label>
                                    <span class="text-danger">*</span>

                                    <select class="form-control kt_select2_2   @error('month') is-invalid @enderror"  name="month">
                                            <option value="{{intval($month)}}">{{$month}}</option>

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
                                    <label>السنة :</label>
                                    <span class="text-danger">*</span>

                                    <select class="form-control kt_select2_2 year @error('year') is-invalid @enderror" name="year">
                                        @if(!is_null($year))
                                            <option value="{{is_null($year)?'':$year}}">{{is_null($year)?'':$year}}</option>
                                        @endif
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
                                @foreach($Customers as $customer)

                                    <div class="col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">اسم المشترك
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control current @error('Customer') is-invalid @enderror" name="Customer[]" disabled

                                               value="{{$customer->full_name}}"/>
                                    </div>
                                    <div class="col-md-3 mg-t-20 mg-md-t-0 test" id="lnWrapper">
                                        {{--                                        <input type="hidden" value="24" class="form-control previous_read @error('previous_reading') is-invalid @enderror" name="previous_reading"/>--}}

                                        <label class="form-control-label"> القراءة الحالية
                                            <span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control current_reading " name="current_reading[]"/>
                                        <input type="hidden"  class="form-control previous_reading @error('previous_reading') is-invalid @enderror"  name="previous_reading[]"/>
                                        <input type="hidden"  class="form-control current_customer @error('current_customer') is-invalid @enderror" name="current_customer[]" value="{{$customer->kw_meter_value}}"/>
                                        <input type="hidden" value="{{$customer->id}}" name="customer_id[]">
                                        <input type="hidden" value="{{$customer->Subtype->min_month_price}}" name="min_month_price[]">

                                        <input type="hidden"  class="form-control price_customer @error('price_customer') is-invalid @enderror" name="price_customer[]"
                                               value="{{$customer->kw_price}}"/>
                                        <input type="hidden" value="{{$customer->Subtype->kw_price}}" name="kw_price_subtype[]" id="kw_price_subtype">

                                        @error('current_reading')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label"> قيمة العداد بالكيلو واط
                                            <span class="text-danger">*</span></label>
                                        <input type="text" style="background:#f6f6f6 " class="form-control total_kw @error('total_kw') is-invalid @enderror" name="total_kw[]"readonly/>
                                        @error('total_kw')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">

                                        <label class="form-control-label">القيمة المستحقة
                                            <span class="text-danger">*</span></label>
                                        <input style="background:#f6f6f6 " type="text" class="form-control total @error('Total') is-invalid @enderror"  name="Total[]" readonly/>
                                        @error('Total')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
@if($Customers->count()>0)
                            <div class="card-footer" style="text-align: end">
                                <button type="submit" class="btn btn-success font-weight-bold mr-2"><span>تاكيد</span> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                <button type="reset" class="btn btn-danger font-weight-bold mr-2 backward"><span>تراجع</span> <i class="fas fa-backspace"></i></button>

                            </div>
    @endif
                        </form>
                    @endif

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
            $('.form_Date').hide();
            var month='';
            $('.current_reading').on('click',function () {
                $('.form_search').hide();
                $('.form_Date').show();
                var d = new Date();
                var n = d.getMonth()+1;
                $('.month_invoice').val(n);
                var y = d.getFullYear();
                $('.year').val(y);
            });
            $('.current_reading').on('click',function () {
                $('.form_search').hide();
                $('.form_Date').show();
            });

            $('.current_reading').on('change', function () {
                var price_kw='';
                var current_reading_value = $(this).val();
                var this_item = $(this);
                var price= this_item.next().next().next().next().next().val();
                var min_month_price =this_item.next().next().next().next().val();
                var previous_reading='';
                var kw_price_subtype= this_item.next().next().next().next().next().next().val();
                var Customer_id=this_item.next().next().next().val();
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
                    if( typeof price === 'undefined' || price=== '' ) {
                        price_kw =this_item.next().next().next().next().next().next().val();
                    }else{
                        price_kw=this_item.next().next().next().next().next().val();
                    }
                    var sub_reading=Number(current_reading_value-previous_reading_value);
                    if(sub_reading<0) {
                 this_item.val('');
                        alert('قراءة القيمة السابقة هي '+previous_reading_value +'القراءة الحالية اصغر منها');
                    }else {
                        this_item.parent().next().find('.total_kw').val(sub_reading);
                        var Total = Number(price_kw * sub_reading);
                        if (Total > min_month_price) {
                            this_item.parent().next().next().find('.total').val(Total);
                        } else {
                            this_item.parent().next().next().find('.total').val(min_month_price);
                        }
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
