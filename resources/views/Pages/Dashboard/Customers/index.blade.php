@extends('layouts.front')
@section('title','المشتركين')
@section('header','عرض  بيانات المشتركين')

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">قائمة المشتركين </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a type="button" href="{{route('Customers.create')}}" class="btn btn-primary"><i class="la la-plus"></i>
                    مشترك جديد
                </a>

                <!--end::Button-->
            </div>

        </div>
        <form id="filter_form" action="">
            @csrf
        <div class="form-group row m-1">
            <div class="col-lg-4">
                <label>الاسم المشترك :</label>
                <select name="full_name" class="form-group row kt_select2_2"
                        style="width: 100%" id="full_name">
                    <option value="">كافة المشتركين</option>
                    @foreach($Customers as $customer)
                        <option value="{{$customer->full_name}}">{{$customer->full_name}}</option>

                    @endforeach
                </select>
                @error('full_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4">
                <label>الايميل :</label>
                <input type="text" class="form-control current @error('email') is-invalid @enderror"  id="email" name="email"
                />
            </div>
            <div class="col-lg-4">
                <label>الهاتف :</label>
                <input type="text" class="form-control current @error('mobile') is-invalid @enderror"  id="mobile" name="mobile"
                />
            </div>
        </div>
            <div class="row">
                <div style="text-align: right;margin: 10px 25px 0 0">
                    <button class="btn btn-primary " id="btnFiterSubmitSearch">بحث</button>

                    <button class="btn btn-primary excel" name="pdf">تصدير Execl </button>
                    <button class="btn btn-primary pdf" name="pdf">تصدير PDF </button>
                </div>
            </div>


        </form>
        <div class="card-body">

            <table class="table table-bordered data-table" >
                <thead>
                <tr>
                    <th width="15%">الاسم</th>
                    <th width="20%">الايميل</th>
                    <th width="20%">الهاتف</th>
                    <th width="20%">العنوان</th>
                    <th width="20%">العمليات</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>


    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        حذف المشترك
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Customers.destroy', 'test') }}" method="post">
                        {{ method_field('Delete') }}
                        @csrf
                        <h4>هل انت متاكدمن عملية الحذف</h4>
                        <input type="hidden">
                        <input id="Delete_id" type="hidden" name="id" class="form-control">
                        <input id="Name_Delete" type="text" name="Name_Delete" class="form-control" disabled>


                        <div class="modal-footer">
                            <button type="submit" name="ok_button" id="ok_button" class="btn btn-danger"><span><i
                                        class="fa fa-paper-plane"
                                        aria-hidden="true"></i></span>تاكيد
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                    class="fa fa-window-close" aria-hidden="true">الغاء</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')

    <script type="text/javascript">
        $(function () {
            var table = $('.data-table').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('Customers.get_custom_Customer') }}",
                    type: 'GET',
                    "data": function (d) {
                        d.full_name = $('#full_name').val();
                        d.mobile = $('#mobile').val();
                        d.email = $('#email').val();
                    }
                },
                columns: [
                    {data: 'full_name', name: 'full_name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'location', name: 'location'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(document).on('click', '.delete', function (e) {
            var $id = $(this).attr('id');
            $('#Delete_id').val($id);

            var Name_Customer = $(this).attr('Name_Customer');
            $('#Name_Delete').val(Name_Customer);

            $('#confirmModal').modal('show');
        });
        $('#btnFiterSubmitSearch').click(function (e) {
            e.preventDefault();

            $('.data-table').DataTable().draw(true);
        });
        $(document).on('click', '.excel', function (e) {
            e.preventDefault();

            let _url = "{{route('Customers.excel')}}";
            $('#filter_form').attr('action', _url);
            $('#filter_form').submit();
        });

        $(document).on('click', '.pdf', function (e) {
            e.preventDefault();

            let _url = "{{route('Customers.pdf')}}";
            $('#filter_form').attr('action', _url);
            $('#filter_form').submit();
        });
    </script>
@endsection
