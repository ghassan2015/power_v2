<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        {{--@page {--}}
        {{--    /*margin: 150px 55px 0px 50px;*/--}}
        {{--background: url('{{ public_path('assets/media/logos/logo.png')}}') no-repeat center;--}}
        {{--    background-image-resize: 2;--}}
        {{--}--}}
        header { position: fixed; top: -140px; left: 0px; right: 0px;  height: 0px; }
        footer { position: fixed; bottom: -120px; left: 0px; right: 0px;  height: 50px; }

        footer .pagenum:before {
            content: counter(page);
        }
        .double-line{
            border-top: 1px solid #8c8b8b;
            border-bottom: 1px solid #fff;
        }

        .double-line:after {
            content: '';
            display: block;
            margin-top: 2px;
            border-top: 1px solid #8c8b8b;
            border-bottom: 1px solid #fff;
        }
        h1,h3,h5,p{
            line-height:1.5;
        }
        u{
            border-bottom: 1.5px dotted #000;
            text-decoration: none;
        }
        div{
            font-size:16px;
            line-height:2;
        }
    </style>
</head>
<body>
<div>
    {{--    <div id="image" style="float:left;">--}}
    {{--                <img src="{{public_path('assets/media/logos/logo.png')}}" width="15px" height="15px"><b>--}}
    {{--    </div>--}}





    <div class="navbar-header">
        <div style="text-align: right">
            <img alt="Oriental Standard Online Course" src="{{public_path('assets/media/logos/logo.png')}}" style="height:7%;width: 7%" />
            <span style="translate(0,100)">الشركة العربية المتحدة للطاقة البديلة</span>
            <div></div>
            <h5>العنوان:مدينة غزة-فلسطين</h5>
            <h5>الهاتف:032487523 </h5>
            <h5>جوال:0567711720 </h5>



        </div>

        <div style="text-align:left;padding-top: -200px">
            {{$day.''.$history}}

        </div>
        <div style="margin-top: 20%"></div>
<h3 style="text-align: center"> فاتورة دورة شهر {{$invoice->month}}</h3>

<table border=1 frame=void rules=rows class="table table-striped table-bordered table-advance table-hover custom-tbl responsive_table_width" style="width:100%">
    <thead>
    <tr>
        <th class="pl-0 font-weight-bold text-muted text-uppercase">دورة الفاتورة</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">القراءة الحالية</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">معدل السحب بالكيلو واط</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">القيمةالاجمالية </th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">الحالة</th>

    </tr>
    </thead>
    <tbody>
    <tr class="font-weight-boldest">
        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{$invoice->month}}-{{$invoice->year}}</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">{{$invoice->current_reading}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$invoice->current_reading-$invoice->previous_reading}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$invoice->total_price}}</th>
        @if ($invoice->status == 0)
            <td class="text-right pr-0 font-weight-bold text-muted text-uppercase">
                <span class="badge badge-danger">غير مدفوع</span></td>

        @elseif ($invoice->status == 1)
            <td class="text-right pr-0 font-weight-bold text-muted text-uppercase">
                <span class="badge badge-warning">  مدفوع جزئي</span></td>

        @elseif ($invoice->status == 2)
            <td class="text-right pr-0 font-weight-bold text-muted text-uppercase">    <span class="badge badge-success">مدفوع</span></td>

        @endif
    </tr>

    </tbody>
</table>
@if($invoice->Payment->count()>0)
<hr>
<table class="table table-striped table-bordered table-advance table-hover custom-tbl responsive_table_width" style="width:100%">
    <thead>
    <tr>
        <th class="pl-0 font-weight-bold text-muted text-uppercase">رقم الدفعة</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">قيمة الدفعة</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">تاريخ الدفع </th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">المحصل</th>

    </tr>
    </thead>
    <tbody>
    @foreach($invoice->Payment as $payment)

        <tr class="font-weight-boldest">
        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{$payment->no_payment}}</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">{{$payment->payment_value}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$payment->created_at->format('m-d-Y')}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$payment->User->name}}</th>

    </tr>
@endforeach
    </tbody>
</table>
@endif
