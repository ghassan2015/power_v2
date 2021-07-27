@extends('layouts.front')
@section('title', 'الرئيسية')
@section('header','قائمةالرئيسية')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">التقارير  </h3>
            </div>
        </div>

            <div class="row mt-5 ml-2 mr-2 mb-2">
            <!--begin::Stats Widget 16-->
        <div class="col-lg-3">
            <!--begin::Stats Widget 17-->
            <a href="{{route('Invoices.index')}}" class="card card-custom bg-radial-gradient-success bg-hover-state-info card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
															<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                    <div class="text-white font-weight-bolder font-size-h5 mb-2 mt-5">
                        الفواتير{{'  '}}<span class="badge badge-pill badge-primary">  {{$Invoices->count()}}</span>
                    </div>
                    <div class="font-weight-bold text-white font-size-sm">اجمالي الدفعات  : {{'  '}}<span class="badge badge-pill badge-primary">{{$total_invoice}} </span> </div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Stats Widget 17-->


        </div>
                    <div class="col-lg-3">
                        <!--begin::Stats Widget 17-->
                        <a href="{{route('Invoices.fullPayment')}}" class="card card-custom bg-radial-gradient-info bg-hover-state-info card-stretch card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
															<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                                <div class="text-white font-weight-bolder font-size-h5 mb-2 mt-5">
                                    الفواتيرالمدفوعة{{'  '}}<span class="badge badge-pill badge-primary">  {{$fully_paidds->count()}}</span>
                                </div>
                                <div class="font-weight-bold text-white font-size-sm">اجمالي الدفعات  : {{'  '}}<span class="badge badge-pill badge-primary">{{$total_fully_paidds}} </span> </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Stats Widget 17-->


                </div>
                <!--end::Body-->         <!--end::Stats Widget 16-->
        <div class="col-lg-3">
            <!--begin::Stats Widget 17-->
            <a href="{{route('Invoices.partially_payment')}}" class="card card-custom bg-radial-gradient-dark bg-hover-state-info card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
															<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                    <div class="text-white font-weight-bolder font-size-h5 mb-2 mt-5">
             الفواتير  المدفوعة  جزئيا{{'  '}}<span class="badge badge-pill badge-primary">  {{$Partially_paidds->count()}}</span>
                    </div>
                    <div class="font-weight-bold text-white font-size-sm">اجمالي الدفعات  : {{'  '}}<span class="badge badge-pill badge-primary">{{$total_Partially_paidds}} </span> </div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Stats Widget 17-->


        </div>

        <div class="col-lg-3">
            <!--begin::Stats Widget 17-->
            <a href="{{route('Invoices.unpaid_invoice')}}" class="card card-custom bg-radial-gradient-secondary bg-hover-state-info card-stretch card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
															<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                    <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5">
                        الفواتير غير المدفوعة {{'  '}}<span class="badge badge-pill badge-primary">  {{$unPaidds->count()}}</span>
                    </div>
                    <div class="font-weight-bold text-inverse-white font-size-sm">اجمالي الدفعات  : {{'  '}}<span class="badge badge-pill badge-primary">{{$total_unPaidds}} </span> </div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Stats Widget 17-->


        </div>

    </div>
        <div class="row m-2">
            <!--begin::Stats Widget 16-->
            <div class="col-lg-3">
                <!--begin::Stats Widget 17-->
                <a href="{{route('Expense.index')}}" class="card card-custom bg-radial-gradient-warning bg-hover-state-info card-stretch card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
															<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                        <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5">
                            المصاريف التشغيلية{{'  '}}<span class="badge badge-pill badge-primary">  {{$Expenses->count()}}</span>
                            <div class="font-weight-bold text-inverse-white font-size-sm">اجمالي المصروفات  : {{'  '}}<span class="badge badge-pill badge-primary">{{$total_Expenses}} </span> </div>

                        </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 17-->


            </div>

            <div class="col-lg-3">
                <!--begin::Stats Widget 17-->
                <a href="{{route('Customers.index')}}" class="card card-custom bg-radial-gradient-danger bg-hover-state-info card-stretch card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
												<span class="svg-icon svg-icon-white svg-icon-3x ml-n1">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
															<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                        <div class="text-inverse-white font-weight-bolder font-size-h5 mb-2 mt-5">
                            المشتركين{{'  '}}<span class="badge badge-pill badge-primary">  {{$Customers->count()}}</span>
                        </div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Stats Widget 17-->


            </div>

        </div>
    </div>
@endsection
