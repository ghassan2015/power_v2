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
                    url: "{{route('Customer.Payments.get_customer_payment')}}",
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
