@extends('layouts.front')
@section('title','الموظفين')
@section('header','قائمة الموظفين ')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">الطاقم الفني والاداري الخاص بالشركة</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a type="button" href="{{route('users.create')}}" class="btn btn-primary"><i class="la la-plus"></i>
                    موظف جديد
                </a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table" style="text-align: right">
                <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">الاسم</th>
                    <th width="20%">الايميل</th>

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
                        حذف الموظف
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.destroy', 'test') }}" method="post">
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
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                },
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $(document).on('click', '.delete', function (e) {
                var $id = $(this).attr('id');
                Name=$(this).attr('name_delete');
                $('#Delete_id').val($id);

                $('#Name_Delete').val(Name);

                $('#confirmModal').modal('show');
            });


        });
    </script>
@endsection
