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

