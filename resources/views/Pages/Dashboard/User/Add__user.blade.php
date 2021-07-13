@extends('layouts.front')
@section('title','الموظفين')
@section('header','اضافة موظف جديد')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div style="float: right;">
                    <h4>اضافة موظف جديد</h4>
                </div>
                <div style="float: left;">
                    <a href="{{route('users.index')}}" type="button" class="btn btn-primary">
                        الرجوع للقائمة السابقة
                        <i class="fas fa-backward"></i>
                    </a>
                </div>

            </div>
            <div class="card-body" style="text-align:right ">
                <form class="form"  id="form" action="{{route('users.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>الاسم :</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="ادخل اسم الموظف"/>
                                @error("name")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>الايميل:</label>
                                <input type="email" class="form-control"
                                       placeholder="ادخل ايميل الموظف" id="email" name="email"/>
                                @error("email")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>كلمة المرور :</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="ادخل كلمة المرور الخاصة بالموظف  "/>
                                @error("password")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>تاكيد كلمة المرور:</label>
                                <input type="password" class="form-control"
                                       placeholder="تاكيد كلمة المرور الخاص بالموظف"
                                       id="confirm-password" name="confirm-password"/>
                                @error("confirm-password")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mg-b-20">
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label> نوع المستخدم <span class="tx-danger">*</span></label>
                                {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple')) !!}

                                @error("roles_name")
                                <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-1">Success</label>
                            <div>
															<span
                                                                class="switch switch-outline switch-icon switch-success">
																<label>
																	<input type="checkbox" checked="checked"
                                                                          value="1"
                                                                           name="Status"/>
																	<span></span>
																</label>
															</span>
                            </div>
                        </div>
                        <!-- end: Example Code-->
                    </div>
                    <div class="card-footer" style="text-align: left">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                               aria-hidden="true"></i></span>تاكيد
                        </button>


                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>



@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#form').validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            // initialize the plugin
            rules: {
                'name': {
                    required: true
                },
                'email': {
                    required: true,
                },
                'password': {
                    required: true,
                },
                'password_confirmation': {
                    required: true,

                },
                'roles_name[]': {
                    required: true,

                },


                errorClass: "error fail-alert",
                validClass: "valid success-alert",


            }
            , messages: {
                'name': {
                    required: "الرجاء ادخل الاسم"
                },
                'email': {
                    required: "الرجاء ادخل الايميل"
                },
                'password': {
                    required: "الرجاء ادخل كلمة المرور"
                },
                'password_confirmation': {
                    required: "الرجاء ادخل كلمة المرور"
                },
                'roles_name[]': {
                    required: "الرجاءادخل الصلاحية الموظف",
                },
            }

        });
    });
</script>
@endsection
