@extends('layouts.front')
@section('content')
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <form class="form" action="{{route('Customer.Profile.update','test')}}" method="post">
            @csrf
            @method('PUT')
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark"> معلومات الخاصة بالحساب الشخصي</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">تغير معلومات الحساب</span>
                </div>

                    <div class="card-toolbar">

                        <button type="submit" class="btn btn-success mr-2">تاكيد<span><i
                                    class="fas fa-check-circle"></i></span></button>
                    </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->

            <div class="card-body">
                <!--begin::Heading-->
                <div class="row" style="text-align: right">
                    <div>
                        <h5 class="font-weight-bold mb-6">الحساب الشخصي:</h5>
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">الاسم</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <input class="form-control form-control-lg form-control-solid" name="full_name" type="text"
                                   value="{{$user->full_name}}"/>
                        </div>
                        @error('full_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!--begin::Form Group-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">الايميل </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="{{$user->email}}" name="email" placeholder="ادخل الايميل الشخصي"/>
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">العنوان </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="{{$user->location}}" name="location" placeholder=" ادخل العنوان"/>
                        </div>
                        @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">ادخل رقم الجوال </label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">

                            <input type="text" class="form-control form-control-lg form-control-solid"
                                   value="{{$user->mobile}}" name="mobile" placeholder="ادخل رقم الجوال"/>
                        </div>
                        @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

            </div>
        </div>
            </form>
            <!--end::Form-->
        </div>

        <!--end::Card-->

@stop
