@extends('layouts.front')
@section('title','الموظفين')
@section('header','تعديل  الموظف ')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div style="float: right;">
                    <h4>اضافة دفعة جديدة</h4>
                </div>
                <div style="float: left;">
                    <a href="{{route('users.index')}}" type="button" class="btn btn-primary">
                        الرجوع للقائمة السابقة
                        <i
                            class="la la-backward"></i>
                    </a>
                </div>

            </div>
            <div class="card-body" style="text-align:right ">
                <form class="form" action="{{route('users.update',$user->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>الاسم :</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{$user->name}}"
                                       placeholder="ادخل اسم الموظف"/>
                                @error("name")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label>الايميل:</label>
                                <input type="email" class="form-control"
                                       value="{{$user->email}}"
                                       placeholder="ادخل ايميل الموظف" id="email" name="email"/>
                                @error("email")
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mg-b-20">
                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>نوع المستخدم <span class="tx-danger">*</span></label>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))

                                                          !!}
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
                                                                           value="مفعل"
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
    </div>
    </div>


@endsection

