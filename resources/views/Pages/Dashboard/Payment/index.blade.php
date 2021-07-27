@extends('layouts.front')
@section('title','الدفعات')
@section('header','قائمة الدفعات ')
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض الدفعات </h3>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
            <form action="{{route('Payments.print_Payment')}}" method="get">
                @csrf

                <div class="form-group row m-1">
                    <div class="col-lg-3 ">
                        <label>اسم الفاتورة:</label>
                        <select name="Invoice_id" class="form-group row kt_select2_2"
                                style="width: 100%"
                                id="Invoice_id">
                            <option value=""> فاتورة</option>
                            @foreach($Payments as $payment)

                                <option value="{{$payment->Invoice->id}}">{{$payment->Invoice->Customer->full_name}}-{{$payment->Invoice->month}}-{{$payment->Invoice->year}}</option>
                            @endforeach
                        </select>
                        @error("Invoice_id")
                        <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-3 ">
                        <label> الشهر :</label>
                        <select name="Month_Payment" class="form-group row kt_select2_2"
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
                    <div class="col-lg-3 ">
                        <label>السنة :</label>
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
                    <div class="col-lg-3 ">
                        <label>الحالة :</label>
                        <select name="Status" class="form-group row kt_select2_2"
                                style="width: 100%"
                                id="Status">
                            <option value="">كل الحالات</option>

                            <option value="2">مدفوع</option>
                            <option value="1">مدفوع جزئي</option>

                            <option value="0"> غير مدفوع</option>
                        </select>

                        @error('years')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="row">
                    <div style="text-align: right;margin: 10px 25px 0 0">
                        <button class="btn btn-primary " id="btnFiterSubmitSearch">بحث</button>


                        <button class="btn btn-primary" name="pdf">تصدير PDF </button>
                    </div>
                </div>

            </form>


            <div class="card-body">

            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th width="15%">المشترك </th>
                    <th width="13%">  تاريخ الفاتورة  </th>
                    <th width="13%"> قيمة الفاتورة الكلية بشيكل  </th>
                    <th width="13%"> قيمة الدفعات  بشيكل  </th>
                    <th width="10%">حالة الدفع</th>
                    <th width="35%">العمليات</th>
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
                        حذف الدفعة
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Payments.destroy', 'test') }}" method="post">
                        {{ method_field('Delete') }}
                        @csrf
                        <h4>هل انت متاكدمن عملية الحذف</h4>
                        <input type="hidden">
                        <input id="Delete_id" type="hidden" name="id" class="form-control">
                        <input id="Name_Delete" type="text" name="Name_Delete" class="form-control" disabled>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"><span><i
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
    </div>    <div id="edit_Payment" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        تعديل دفعة
                                          </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Payments.update','test') }}" method="post">
                        @csrf
                        @method('put')
                        <input id="Payment_id" type="hidden" name="id" class="form-control">
                        <input id="Invoices_id" type="hidden" name="Invoice_id" class="form-control">
                        <input id="month" type="hidden" name="month" class="form-control">
                        <input id="year" type="hidden" name="year" class="form-control">

                        <div class="form-group">
                            <label for="exampleInputPassword1"> اسم الفاتورة :</label>
                            <span class="text-danger">*</span>

                            <input id="Name_Customer_Payment" type="text" name="Name_Customer_Payment" class="form-control" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">  قيمة الدفعة :</label>
                            <span class="text-danger">*</span>

                            <input id="payment_value" type="text" name="payment_value" class="form-control" >
                        </div>
                        <input id="user_id" type="hidden" value="{{auth()->user()->id}}" name="user_id" class="form-control" >

                        <div class="modal-footer">
                            <button type="submit" class="edit-button btn btn-primary"><span><i class="fa fa-paper-plane"></i></span>تاكيد
                            </button>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-window-close" aria-hidden="true"></i>
                                اغلاق
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <@stop
@section('js')
    <script type="text/javascript">
        $(document).on('click', '.payment', function (e) {
            e.preventDefault();
            var $id = $(this).attr('id');
            $('#Payment_id').val($id);
            var Name_Customer = $(this).attr('Name_Invoice');
            $('#Name_Customer_Payment').val(Name_Customer);
            var Invoice_id=$(this).attr('invoice_id');
            $('#Invoices_id').val(Invoice_id);
            var month=$(this).attr('month');
            $('#month').val(month);
            var year=$(this).attr('year');
            $('#year').val(year);
            var payment_value=$(this).attr('payment_value');
            $('#payment_value').val(payment_value);

            $('#edit_Payment').modal('show');
        });

        $(document).on('click', '.delete', function (e) {
            var $id = $(this).attr('id');
            var Name_Delete = $(this).attr('Name_Delete');

            $('#Delete_id').val($id);

            $('#Name_Delete').val(Name_Delete);

            $('#confirmModal').modal('show');
        });


        // $('#ok_button').click(function () {
        //     $.ajax({
        //         url: "/Dashboard/Invoice/destroy/" + invoice_id,
        //         beforeSend: function () {
        //             $('#ok_button').text('Deleting...');
        //         }
        //         ,
        //         success: function (data) {
        //             setTimeout(function () {
        //                 $('#confirmModal').modal('hide');
        //                 $('.data-table').DataTable().ajax.reload();
        //             }, 2000);
        //         }
        //     })
        // });
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                },
                ajax: {
                    url: "{{route('Payments.get_custom_payment')}}",
                    type: 'GET',
                    "data": function (d) {
                        d.Invoice_id = $('#Invoice_id').val();
                        d.Years_Payment = $('#Years_Payment').val();
                        d.Status = $('#Status').val();
                        d.Month_Payment = $('#Month_Payment').val();
                    }
                },
                columns: [
                    {data: 'Customer', name: 'Customer'},
                    {data: 'Date', name: 'Date'},
                    {data: 'Invoice_Total_Price', name: 'Invoice_Total_Price'},
                    {data: 'payment', name: 'payment'},
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
        $('#btnFiterSubmitSearch').click(function (e) {
            $('.data-table').DataTable().draw(true);
            e.preventDefault();
        });
    </script>

@endsection
