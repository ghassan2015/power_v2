@extends('layouts.front')
@section('title','الفواتير')
@section('header','عرض  الفاتورة ')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->

        <div class="container">
            <!-- begin::Card-->
            <div class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0"
                         style="background-image: url({{asset('assets/media/bg/bg-6.jpg')}});">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 text-white font-weight-boldest mb-10">
                                    فاتورة  شهر
                                    {{ $invoice->created_at->format('M-m')}}
                                </h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <!--begin::Logo-->
                                    <a href="#" class="mb-5">
                                        <img src="assets/media/logos/logo-light.png" alt=""/>
                                    </a>
                                    <!--end::Logo-->

                                </div>
                            </div>
                            <div class="border-bottom w-100 opacity-20"></div>
                            <div class="d-flex justify-content-between text-white pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolde mb-2r">تاريخ الفاتورة</span>
                                    <span class="opacity-70">{{ $invoice->created_at->format('M-m')}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">رقم الفاتورة:</span>
                                    <span class="opacity-70">{{ $invoice->Customer->full_name.'/'.$invoice->created_at->format('M-m')}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">اسم المشترك</span>
                                    <span class="opacity-70">{{ $invoice->Customer->full_name}}
                                    </span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">العنوان</span>
                                    <span class="opacity-70">{{$invoice->Customer->location}}

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">رقم الفاتورة</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">سعر الكيلوواط الواحد
                                        </th>

                                        <th class="text-right font-weight-bold text-muted text-uppercase">معدل السحب
                                            بالكيلو واط
                                        </th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">قيمة
                                            المستحقة للدفع
                                        </th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">قيمة
                                            الدفعات
                                        </th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">
                                            حالة الدفع
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td class="pl-0 pt-7">{{$invoice->Customer->full_name}}</td>
                                        <td class="text-right pt-7">{{$invoice->Customer->kw_price}}</td>
                                        <td class="text-right pt-7">{{($invoice->current_reading)-($invoice->previous_reading)}}</td>
                                        <td class="text-danger pr-0 pt-7 text-right">{{$invoice->total_price}}
                                            <span><i class="fas fa-shekel-sign" style="color: #000000 ;font-size: 12px"></i></span></td>
                                        <td class="text-right pt-7">{{($invoice->total_price)-($invoice->remaining)}}    <span><i class="fas fa-shekel-sign" style="color: #000000 ;font-size: 12px"></i></span></td>

                                        <td class="text-danger pr-0 pt-7 text-right">

                                            @if($invoice->status==2)
                                                <span class="badge badge-success">مدفوعة</span>
                                            @else
                                                <span class="badge badge-danger">  مدفوعة جزئي</span>
                                        @endif

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">

                                <button type="button" class="btn btn-primary font-weight-bold"
                                        onclick="window.print();">طباعة الفاتورة
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!-- end::Card-->
        </div>
        <!--end::Container-->
    </div>
@endsection
