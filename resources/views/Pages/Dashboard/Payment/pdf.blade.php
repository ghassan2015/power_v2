<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            /*margin: 150px 55px 0px 50px;*/
            background: url('{{ public_path('assets/media/logos/logo.png')}}') no-repeat center;
            background-image-resize: 2;
        }
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
<h3 style="text-align: center">كشف الدفعات</h3>
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
    @foreach($data as $payment)

        <tr class="font-weight-boldest">
            <th class="pl-0 font-weight-bold text-muted text-uppercase">{{$payment->no_payment}}</th>
            <th class="text-right font-weight-bold text-muted text-uppercase">{{$payment->payment_value}}</th>
            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$payment->created_at->format('m-d-Y')}}</th>
            <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$payment->User->name}}</th>

        </tr>
    @endforeach
    </tbody>
</table>

