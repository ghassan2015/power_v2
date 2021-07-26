
<!DOCTYPE html>

<html lang="en" direction="rtl" style="direction: rtl;">
<!--begin::Head-->
<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Page with empty content" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    @yield('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=Katibeh&family=Lateef&family=Reem+Kufi:wght@500&display=swap" rel="stylesheet">
    <!--begin::Page Vendors Styles(used by this page)-->
    {{--    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
    @toastr_css
    <!--end::Fonts-->
    <!--begin::Layout Themes(used by all pages)-->
    {{--    <link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />--}}
    {{--    <link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />--}}
    {{--    <link href="{{asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />--}}
    {{--    <link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />--}}

    <style>


        #DataTables_Table_0_filter{
            padding:0 58% 0 0 ;
        }

        input.error.fail-alert {
            color:red;
            border: 2px solid red;

        }
        label.error.fail-alert {
            color:red;

        }

        input.valid.success-alert {
            border: 2px solid #4CAF50;
            color: green;
        }
    </style>
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<scrip src="{{ asset('frontend/js/fontawesome/all.min.js') }}"></scrip>
<script>
    $(function () {
        $('#session-alert').fadeTo(2000, 500).slideUp(500, function () {
            $('#session-alert').slideUp(500);
        })
    })
</script>

@yield('script')

</body>
</html>
