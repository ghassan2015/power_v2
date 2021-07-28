@extends('Layouts.front')
@section('title','كشف حساب')
@section('header','كشف حساب المشترك')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title text-center" >

                            فواتيري                        </h3>
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
                                            @endforeach

											</tbody>
                                        </table>
                                    </span>

                   </div>

            </div>
        </div>
    </div>


@endsection
