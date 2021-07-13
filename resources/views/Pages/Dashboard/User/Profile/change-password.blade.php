@extends('layouts.front')
@section('title','تغير كلمة المرور')
@section('content')
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">تغير كلمة مرور</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">تغير كلمة مرور حسابي الشخصي</span>
                </div>
                <form class="form" action="{{route('change.password')}}" method="post">
                    @csrf
                    <div class="card-toolbar">
                        <button type="submit" class="btn btn-success mr-2">تاكيد<span><i
                                    class="fas fa-check-circle"></i></span></button>
                    </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->

            <div class="card-body">
                <!--begin::Alert-->
                <!--end::Alert-->
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">كلمة مرور الحالية</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="current_password"
                               class="form-control form-control-lg form-control-solid mb-2" value=""
                               placeholder="كلمة المرور الحالية"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">كلمة مرور الجديدة</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="new_password"
                               class="form-control form-control-lg form-control-solid" value=""
                               placeholder="كلمة المرور الجديدة"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">تاكيد كلمة المرور</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="new_confirm_password"
                               class="form-control form-control-lg form-control-solid" value=""
                               placeholder="تاكيد كلمة المرور"/>
                    </div>
                </div>
            </div>
            </form>
            <!--end::Form-->
        </div>
    </div>

@stop
