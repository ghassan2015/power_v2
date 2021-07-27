@extends('layouts.front')
@section('title','الصلاحيات')
@section('header','عرض  الصلاحيات')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض الصلاحيات </h3>
            </div>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('Roles.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الصلاحية</label>
                    <input type="text" name="Name" class="form-control"
                           value="{{$role->name}}"
                           id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="ادخل اسم الصلاحية" required>
                    @error('Name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group row">
                    @foreach($rolePermissions as $permission)
                        <label class="col-2 col-form-label">{{$permission->name}}</label>
                        <div>
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox"
                                                           name="permission[]" value="{{$permission->id}}"/>
                                                    <span></span>
                                                </label>
                                            </span>
                        </div>
                    @endforeach

                </div>
                <!-- /col -->
                <div class="card-footer" style="text-align: left">
                    <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                           aria-hidden="true"></i></span>تاكيد
                    </button>


                </div>

            </form>


            <!-- /col -->


            <!-- row closed -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->


@endsection
