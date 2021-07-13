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


        <div class="form-group row m-1">
            <div class="col-lg-3 pr-1">
                <label>فاتورة المشترك:</label>
                <select name="Invoice_id" class="form-group row kt_select2_2"
                        style="width: 100%;float: right" id="Invoice_id">
                    <option value="">كل الفواتير</option>
                 @foreach($Payments as $payment)
                        <option value="{{$payment->Invoice->id}}">{{$payment->Invoice->Customer->full_name}} {{''."فاتورة" .''}} {{$payment->Invoice->created_at->format('Y.m.d')}}</option>

                    @endforeach
                </select>

                @error("Invoice_id")
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-3 ">
                <label>الشهر :</label>
                <select name="Month_Payment" class="form-group row kt_select2_2"
                        style="width: 100%" id="Month_Payment">
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
                <label> السنة:</label>
                <select name="Years_Payment" class="form-group row kt_select2_2"
                        style="width: 100%"
                        id="Years_Payment">
                    <option value="">السنة الحالية</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>

                @error('Years_Payment')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-3 ">
                <label>قيمة العدادالحالية :</label>
                <select name="Status" class="form-group row kt_select2_2"
                        style="width: 100%"
                        id="Status">
                    <option value="">كل الحالات</option>

                    <option value="2">مدفوع</option>
                    <option value="1">مدفوع جزئي</option>
                </select>

                @error('years')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="row">
            <div class="col-sm-1 col-md-1">
                <button class="btn btn-primary btn-block" id="btnFiterSubmitSearch">بحث</button>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                <tr>
                    <th width="2%">#</th>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Confirmation</h2>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">هل انت متاكدمن عملية الحذف</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger"><span><i
                                class="fa fa-paper-plane"
                                aria-hidden="true"></i></span>تاكيد
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-window-close" aria-hidden="true">الغاء</i></button>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_Payment" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        اضافة دفعة جديدة                    </h5>
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
                            <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                                   aria-hidden="true"></i></span>تاكيد
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
            var $id = $(this).attr('id');
            $('#Payment_id').val($id);
            var Name_Customer = $(this).attr('Name_Invoice');
            $('#Name_Customer_Payment').val(Name_Customer);
            var Invoice_id=$(this).attr('invoice_id');
            $('#Invoices_id').val(Invoice_id);
            var payment_value=$(this).attr('payment_value');
            $('#payment_value').val(payment_value);

            $('#edit_Payment').modal('show');
        });
        $(document).on('click', '.delete', function (e) {
            var $id = $(this).attr('id');
            var Payment_id = $(this).attr('Payment_id');
            $('#Delete_id').val($id);

            $('#Name_Delete').val(Payment_id);

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
                    {data: 'id', name: 'id'},
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
        $('#btnFiterSubmitSearch').click(function () {
            $('.data-table').DataTable().draw(true);
        });
    </script>

@endsection
