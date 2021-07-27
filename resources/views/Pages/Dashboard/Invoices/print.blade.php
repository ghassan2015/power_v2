<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /*@page {*/
            /*margin: 150px 55px 0px 50px;*/
        {{--    background: url('{{ public_path('assets/media/logos/logo.png')}}') no-repeat center;--}}
        {{--    background-image-resize: 2;--}}
        {{--}--}}

        header { position: fixed; top: -140px; left: 0px; right: 0px;  height: 0px; }
        footer { position: fixed; bottom: -120px; left: 0px; right: 0px;  height: 50px; }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: right;
            padding: 8px;
        }

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
            {{$date.' '. $history}}

        </div>
<div style="margin-top: 20%"></div>
<h3 style="text-align: center">قائمة الفواتير  </h3>
<table border=1 frame=void rules=rows>

    <thead>
    <tr>

        <th class="pl-0 font-weight-bold text-muted text-uppercase">المشترك</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">دورة الفاتورة</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">القراءة الحالية</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">القراءة السابقة</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">معدل السحب بالكيلو واط</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">القيمةالاجمالية </th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">الحالة</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $invoice)
        <tr>
        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{$invoice->Customer->full_name}}</th>
            <th class="text-right font-weight-bold text-muted text-uppercase">{{$invoice->month}}-{{$invoice->year}}</th>

            <th class="text-right font-weight-bold text-muted text-uppercase">{{$invoice->current_reading}}</th>
            <th class="text-right font-weight-bold text-muted text-uppercase">{{$invoice->previous_reading}}</th>

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
            @endforeach
    <tr>
        <th>#</th>
        <th>المجموع</th>

        <th class="text-right font-weight-bold text-muted text-uppercase">{{$current_reading}}</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">{{$previous_reading}}</th>

        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$total_kw}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$total_price}}</th>
    </tr>
    </tbody>
</table>
<script>
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
    </script>
