@extends('layouts.front')
@section('title', 'المصاريف التشغيلية')
@section('header','قائمة عرض  المصاريف التشغيلية')
@section('content')
    <div class="card card-custom">
        <div class="card-header">

            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label">لوحة عرض المصروفات التشغيلية </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModal"><i class="la la-plus"></i>اضافة مصروفات تشغيلية جديد
                </button>

                <!--end::Button-->
            </div>

        </div>
        <form action="{{route('Expense.print_Expense')}}" method="get">
            @csrf
        <div class="form-group row m-3">
            <div class="col-lg-4">
                <label>نوع المصاريف:</label>
                <select name="Month_Expense" class="form-group row kt_select2_2"
                        style="width: 100%"
                        id="Option_type">
                    <option value=""> نوع المصاريف</option>
                    @foreach($Options as $Option)
                        <option value="{{$Option->id}}">{{$Option->name}}</option>
                    @endforeach
                </select>
                @error("Option_id")
                <span class="text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-4 ">
                <label> الشهر :</label>
                <select name="Month_Expense" class="form-group row kt_select2_2"
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

                @error('Month_Expense')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-lg-4 ">
                <label>السنة :</label>
                <select name="Year_Expense" class="form-group row kt_select2_2"
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

        </div>
            <div class="row">
                <div style="text-align: right;margin: 10px 25px 0 0">
                    <button class="btn btn-primary " id="btnFiterSubmitSearch">بحث</button>


                    <button class="btn btn-primary" name="pdf">تصدير PDF </button>
                </div>
            </div>
        </form>
        <div class="card-body">

            <table class="table table-bordered data-table" style="text-align: right">
                <thead>
                <tr>
                    <th width="30%">الاسم</th>
                    <th width="20%">قيمة المصروفات</th>
                    <th width="30%">العمليات</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>



    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مصاريف تشغيلية جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate action="{{route('Expense.store')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputPassword1">اسم المصاريف</label>
                            <input type="text" name="Name" class="form-control"
                                   id="Name"
                                   placeholder="ادخال الاسم الخاص بالمصاريف" required>
                            <div class="invalid-feedback">
                                الرجاء ادخال الاسم الخاص بالمصاريف
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نوع المصاريف </label>
                        </div>
                        <div class="form-group">

                            <select name="Option_id" class="custom-select kt_select2_2"
                                    onclick="console.log($(this).val())" style="width: 100%">
                                <!--placeholder-->
                                @foreach ( $Options as  $option)
                                    <option
                                        value="{{ $option->id }}">
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Option_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">قيمة المصاريف</label>
                            <input type="text" name="Value" class="form-control" id="Value"
                                   aria-describedby="emailHelp" placeholder="ادخل قيمة المصاريف" required>
                            <div class="invalid-feedback">
                                الرجاء ادخل قيمة المصاريف
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>


                    </div>
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
    <div class="modal fade" id="edit_Expense_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" style="text-align: right">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة مصاريف تشغيلية جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate action="{{route('Expense.update','test')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" class="form-control"
                               id="Expense_id"
                               placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                        <div class="form-group">
                            <label for="exampleInputPassword1">اسم المصاريف</label>
                            <input type="text" name="Name" class="form-control"
                                   id="Name_Expense"
                                   placeholder="الرجاء ادخل مكان الصندوق هنا" required>
                            <div class="invalid-feedback">
                                الرجاء ادخال الاسم الخاص بالمصاريف
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> نوع المصاريف </label>
                        </div>
                        <div class="form-group">

                            <select id="Option_id" name="Option_id" class="Option_id custom-select kt_select2_2"
                                    onclick="console.log($(this).val())" style="width: 100%">
                                <!--placeholder-->
                                @foreach ( $Options as  $option)
                                    <option
                                        value="{{ $option->id }}">
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Box_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">قيمة المصاريف</label>
                            <input type="text" name="Value" class="form-control" id="Price"
                                   aria-describedby="emailHelp" placeholder="ادخل رقم العداد" required>
                            <div class="invalid-feedback">
                                الرجاء ادخل قيمة المصاريف
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>


                    </div>
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
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        حذف العداد
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Expense.destroy', 'test') }}" method="post">
                        {{ method_field('Delete') }}
                        @csrf
                        <h4>هل انت متاكدمن عملية الحذف</h4>
                        <input type="hidden">
                        <input id="Delete_id" type="hidden" name="id" class="form-control">
                        <input id="Name_Expense_delete" type="text" name="Name_Delete" class="form-control" disabled>


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
        box_id = '';

        $(document).on('click', '.delete', function () {
            Expense_id = $(this).attr('id');
            Name_Expense = $(this).attr('Name_Expense');
            $('#Delete_id').val(Expense_id);
            $('#Name_Expense_delete').val(Name_Expense);

            $('#confirmModal').modal('show');
        });
        $(document).on('click', '.edit_Expense', function (e) {
            $('#edit_Expense_modal').modal('show');
            var Expense_id = $(this).attr('id');
            $('#Expense_id').val(Expense_id);

            var Name = $(this).attr('Name_Expense');
            $('#Name_Expense').val(Name);
            var Price = $(this).attr('Price');
            $('#Price').val(Price);
            var Option_Name = $(this).attr('Option_Name');
            var Option_id = $(this).attr('Option_id');

            $('.Option_id').val(Option_id).trigger('change');

            // $('#Option_id').append(`<option value="${Option_id}">
            //                            ${Option_Name}
            //                       </option>`).prop('selected');
            // var Expense_id = $(this).attr('id');
            // $('#id').val(Expense_id);

        });


        $(function () {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                },
                ajax: {
                    url: "{{ route('Expense.getExpense') }}",
                    type: 'GET',
                    "data": function (d) {
                        d.Option_id = $('#Option_type').val();
                        d.Year_Expense = $('#years').val();
                        d.Month_Expense = $('#Month').val();
                    }
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'price_expenses', name: 'price_expensesn'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        $('#btnFiterSubmitSearch').click(function () {
            $('.data-table').DataTable().draw(true);
        });

    </script>
@endsection
