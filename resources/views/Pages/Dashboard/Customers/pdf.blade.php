<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        {{--@page {--}}
        {{--    /*margin: 150px 55px 0px 50px;*/--}}
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
<img src="{{public_path('assets/media/logos/logo.png')}}" width="100px" height="100px">
<h3 style="text-align: center">كشف المشتركين </h3>
<table  style="width:100%">
    <thead>
    <tr>
        <th class="pl-0 font-weight-bold text-muted text-uppercase">الاسم</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">الايميل</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">رقم الهاتف</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">العنوان </th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $customer)
    <tr>
        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{$customer->full_name}}</th>
        <th class="text-right font-weight-bold text-muted text-uppercase">{{$customer->email}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$customer->mobile}}</th>
        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{$customer->location}}</th>
    </tr>
@endforeach
    </tbody>
</table>

