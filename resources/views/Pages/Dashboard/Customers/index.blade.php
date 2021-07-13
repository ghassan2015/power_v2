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
        <div class="card-body">
            <table class="table table-bordered data-table" >
                <thead>
                <tr>
                    <th width="5%">No</th>
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
                processing: true,
                serverSide: true,

                ajax: "{{ route('Customers.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
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

    </script>
@endsection
