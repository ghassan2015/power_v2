@extends('layouts.front')
@section('title','الفواتير')
@section('header','قائمة الفواتير ')

@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض الفواتير </h3>
            </div>


        </div>


        <div class="form-group row m-1">
            <div class="col-lg-4">
                <label>قيمة العدادالحالية :</label>
                <select name="Month_Invoice" class="form-group row kt_select2_2"
                        style="width: 100%" id="Month">
                    <option value="">كل الاشهر</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>

                @error('Month')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4">
                <label>قيمة العدادالحالية :</label>
                <select name="years" class="form-group row kt_select2_2"
                        style="width: 100%"
                        id="years">
                    <option value="">السنة الحالية</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>

                @error('years')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-4">
                <label>قيمة العدادالحالية :</label>
                <select name="Status" class="form-group row kt_select2_2"
                        style="width: 100%"
                        id="Status">
                    <option value="">كل الحالات</option>
                    <option value="0"> غير مدفوع</option>
                    <option value="1">مدفوع جزئي</option>
                    <option value="2">مدفوع</option>

                </select>

                @error('years')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="row">
            <div class="col-sm-1 col-md-1 m-5">
                <button class="btn btn-primary btn-block" id="btnFiterSubmitSearch">بحث</button>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th width="15%">اسم المشترك</th>
                    <th width="15%">دورة الفاتورة </th>
                    <th width="15%"> قيمة كيلو واط   </th>
                    <th width="15%"> قيمة السحب بالكيلو واط</th>
                    <th width="15%"> قيمة الفاتورة   </th>
                    <th width="15%"> الباقي   </th>
                    <th width="13%">حالة الدفع</th>
                    <th width="10%">العمليات</th>
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
                        حذف الفاثورة
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Invoices.destroy', 'test') }}" method="post">
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

{{--    <div id="Create_Payment" class="modal fade" role="dialog">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"--}}
{{--                        id="exampleModalLabel">--}}
{{--                        اضافة دفعة جديدة                    </h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal"--}}
{{--                            aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form action="{{ route('Invoices.payment.store') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <input id="Payment_id" type="hidden" name="invoice_id" class="form-control">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputPassword1"> اسم الفاتورة :</label>--}}
{{--                            <span class="text-danger">*</span>--}}

{{--                            <input id="Name_Customer_Payment" type="text" name="Name_Customer_Payment" class="form-control" readonly="readonly">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputPassword1">  قيمة الدفعة :</label>--}}
{{--                            <span class="text-danger">*</span>--}}

{{--                            <input id="payment_value" type="text" name="payment_value" class="form-control" >--}}
{{--                        </div>--}}
{{--                        <input id="user_id" type="hidden" value="{{auth()->user()->id}}" name="user_id" class="form-control" >--}}

{{--                        <div class="modal-footer">--}}
{{--                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"--}}
{{--                                                                                   aria-hidden="true"></i></span>تاكيد--}}
{{--                            </button>--}}

{{--                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i--}}
{{--                                    class="fa fa-window-close" aria-hidden="true"></i>--}}
{{--                                اغلاق--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <@stop
@section('js')
    <script type="text/javascript">

        $(document).on('click', '.payment', function (e) {
            var $id = $(this).attr('id');
            var Name_Customer = $(this).attr('Name_Customer_Payment');
            $('#Payment_id').val($id);
            $('#Name_Customer_Payment').val(Name_Customer);

            $('#Create_Payment').modal('show');
        });

        invoice_id = '';
        $(document).on('click', '.delete', function (e) {
            var $id = $(this).attr('id');
            Name_Customer=$(this).attr('Name_Customer');
            $('#Delete_id').val($id);

            $('#Name_Delete').val(Name_Customer);

            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function () {
            $.ajax({
                url: "/Dashboard/Invoice/destroy/" + invoice_id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                }
                ,
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{route('Customer.Invoices.get_customer_invoice')}}",
                    type: 'GET',
                    "data": function (d) {
                        d.Customer_id = $('#Customer_id').val();
                        d.years = $('#years').val();
                        d.Month_Invoice = $('#Month').val();
                        d.Status = $('#Status').val();
                    }
                },
                columns: [
                    {data: 'Customer', name: 'Customer'},
                    {data: 'Date', name: 'Date'},
                    {data: 'k_w_price', name: 'k_w_price'},
                    {data: 'total_kw', name: 'total_kw'},
                    {data: 'total_price', name: 'total_price'},
                    {data: 'remaining', name: 'Remaining'},
                    {data: 'status', name: 'status'},


                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


        });
        $(document).ready(function () {
            $('#invoice_number').hide();
            $('input[type="radio"]').click(function () {
                if ($(this).attr('id') == 'type_div') {
                    $('#invoice_number').hide();
                    $('#type').show();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#invoice_number').show();
                    $('#type').hide();
                    $('#start_at').hide();
                    $('#end_at').hide();
                }
            });
        });
        $('#btnFiterSubmitSearch').click(function () {
            $('.data-table').DataTable().draw(true);
        });
    </script>

@endsection
