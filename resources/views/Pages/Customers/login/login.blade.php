@extends('layouts.login')
@section('content')
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
             id="kt_login">
            <!--begin::Aside-->


            <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                <!--begin::Aside Top-->
                <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                    <!--begin::Aside header-->
                    <a href="#" class="text-center mb-10">
                        <img src="assets/media/logos/logo-letter-1.png" class="max-h-70px" alt=""/>
                    </a>
                    <!--end::Aside header-->
                    <!--begin::Aside title-->
                    <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                       مرحبابكم
                        <br/>في صفحة دخول المشتركين</h3>
                    <!--end::Aside title-->
                </div>
                <!--end::Aside Top-->
                <!--begin::Aside Bottom-->
                <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{asset('assets/media/svg/illustrations/login-visual-1.svg')}})"></div>
                <!--end::Aside Bottom-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <!--begin::Form-->
                        <form class="myform"  id="myform" action="{{route('postLogin')}}" method="post">
                            @csrf
                            <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">مرحبا بك
                                    </h3>
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <span class="text-danger">*</span>

                                    <label class="font-size-h6 font-weight-bolder text-dark">الايميل</label>
                                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg email" type="email" name="email" />
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <span class="text-danger">*</span>
                                    <label class="font-size-h6 font-weight-bolder text-dark">كلمةالمرور</label>
                                    <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg password" type="password"
                                           name="password"/>

                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!--end::Form group-->
                                <!--begin::Action-->
                                <div class="pb-lg-0 pb-5">
                                    <button type="submit"
                                            class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                                        تسجيل الدخول
                                    </button>

                                </div>
                                <!--end::Action-->
                            </form>

                        <!--end::Form-->
                    </div>

                </div>
                <!--end::Content body-->
                <!--begin::Content footer-->
                <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                    <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                        <span class="mr-1">2021©</span>
                        <a href="https://www.facebook.com/shiftictcom" target="_blank"
                           class="text-dark-75 text-hover-primary">شِفت لتكنولوجيا المعلومات والإتصالات - Shift ICT </a>
                    </div>
                </div>
                <!--end::Content footer-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
@endsection
@section('js')
<script>
    $(document).ready(function () {

        $('#myform').validate({ // initialize the plugin
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                }
            }
        });

    });

</script>
@endsection
