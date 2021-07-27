@extends('Layouts.front')
@section('title','كشف حساب')
@section('header','كشف حساب المشترك')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                             حساب المشترك
                        </h3>
                    </div>
                </div>

                    <input type="hidden" name="_token" value="Ta7vSUWymxQsIcztIgkipkSd2QyjAPTSOioTIgNS">
                    <input type="hidden" name="contract_id" value="327"/>
                    <div class="kt-portlet__body">
                                    <span id="pdf_export_block">
                                        <table class="table table-striped table-hover" style="border-collapse: collapse;margin: 20px;text-align:center; width:95%; border:1px" border="1">
											<thead>
                                                <tr style="background-color:#9dbcea">
                                                    <th colspan="8"><h3>كشف حساب المشترك</h3></th>
                                                </tr>
                                                <tr>
                                                    <th>اسم المشترك</th>
                                                    <th >{{$Customer->full_name}}</th>
                                                    <th><b>العنوان</b></th>
                                                    <th>{{$Customer->location}}</th>
                                                    <th><b>رقم الهاتف</b></th>
                                                    <th>{{$Customer->mobile}}</th>
                                                </tr>
                                                <tr>
                                                     <th><b>نوع الخط الكهربائي</b></th>
                                                    <th>{{$Customer->Subtype->name}}</th>
                                                    <th><b>سعر الكيلو واط الواحد</b></th>
                                                    <th>{{is_null($Customer->kw_price)?($Customer->Subtype->kw_price):($Customer->kw_price)}}</th>


                                                </tr>
											</thead>

                                        </table>

                                        <br>

                                        <table class="table table-striped table-hover" style="border-collapse: collapse;margin: 20px;text-align:center; width:95%; border:1px" border="1">
                                            <thead>
                                                <tr style="background-color:#9dbcea">
                                                    <th width="3%"><label class="kt-checkbox"><input id="select_all" value="1" type="checkbox"/><span></span></label></th>
                                                    <th> دورة الفاتورة</th>
                                                    <th>القراءة الحالية</th>
                                                    <th>القراءة السابقة</th>
                                                    <th>كمية الاستهلاك   بالكيلو واط</th>
                                                    <th>القيمة الاجمالية للفاتورة </th>
                                                    <th>المدفوع</th>
                                                    <th>المتبقي </th>
                                                    <th>حالة </th>
                                                    <td>دفعة</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Invoices as $Invoice)
                                                <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox--single"></label>
                                                </td>
                                                <td>{{$Invoice->created_at->format('Y-m')}}</td>
                                                <td>{{$Invoice->current_reading}}</td>
                                                <td>{{$Invoice->previous_reading}}</td>
                                                <td>{{($Invoice->current_reading)-($Invoice->previous_reading)}}</td>
                                                    <td>{{$Invoice->total_price}}</td>
                                                    <td>{{($Invoice->total_price)-($Invoice->remaining)}}</td>
                                                    <td>{{$Invoice->remaining}}</td>

                                                <td>
                                                    @if($Invoice->status==2)
                                                        <span class="badge badge-success">مدفوع </span>

                                                        @elseif($Invoice->status==1)
                                                        <span class="badge badge-secondary">مدفوع جزئي</span>

                                                    @else

                                                        <span class="badge badge-danger">غير مدفوع</span>

                                                    @endif

                                                </td>
                                                    <td>
                                                        <a class="payment" data-id="{{$Invoice->id}}" data-Invoice="{{$Invoice->Customer->full_name}}"><span><i class="payment icon-3x fab fa-cc-apple-pay"></i></span></a>
                                                    </td>
                                            @endforeach

											</tbody>
                                        </table>
                                    </span>

                   </div>

            </div>
        </div>
    </div>
    <div id="Create_Payment" class="modal fade" role="dialog">
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
                    <form action="{{ route('Invoices.payment.store') }}" method="post" id="form">
                        @csrf
                        <input id="month" type="hidden" name="month" class="form-control">
                        <input id="year" type="hidden" name="year" class="form-control">

                        <input id="Invoice_id" type="text" name="invoice_id" class="form-control">
                        <div class="form-group">
                            <label for="exampleInputPassword1">  رقم ايصال الدفعة:</label>
                            <span class="text-danger">*</span>

                            <input id="payment_no" type="text" name="payment_no" class="form-control payment_no">
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


@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click', '.payment', function (e) {
           var Name_Customer_Payment= $(this).attr('data-Invoice');

            $('#Name_Customer_Payment').val(Name_Customer_Payment);
            var Invoice_id= $(this).attr('data-id');
            $('#Invoice_id').val(Invoice_id);
            var d = new Date();
            var n = d.getMonth()+1;
            $('#month').val(n);
            var year = d.getFullYear();
            $('#year').val(year);

            $('#Create_Payment').modal('show');
        });
        $('#form').validate({
            errorClass: "error fail-alert",
            validClass: "valid success-alert",
            // initialize the plugin
            rules: {
                'invoice_id': {
                    required: true
                },
                'Name_Customer_Payment': {
                    required: true,

                },
                'payment_value': {
                    required: true,
                },

                errorClass: "error fail-alert",
                validClass: "valid success-alert",


            }
            , messages: {
                'Name_Customer_Payment': {
                    required: "الرجاءاسم المشترك"
                },
                'payment_value': {
                    required: " الرجاء ادخل قيمة الدفعة",
                },




            }
        });

    </script>
@stop
