<table>
    <thead>
    <tr>
        <th style="color: red">اسم المشترك</th>
        <th style="color: red">قيمة القراءة الحالية</th>
        <th style="color: red">قيمة القراءة السابقة </th>
        <th style="color: red">قيمة الاستهلاك kw</th>
        <th style="color: red">قيمة الاجمالية بالشيكل</th>
        <th style="color: red">الباقي</th>
        <th style="color: red">الشهر</th>
        <th style="color: red">السنة  </th>


    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $invoice)
        <tr>
            <th>{{$invoice->Customer->full_name}}</th>
            <td>{{ $invoice->current_reading }}</td>
            <td>{{ $invoice->previous_reading }}</td>
            <td>{{ $invoice->total_kw }}</td>
            <td>{{ $invoice->total_price }}</td>
            <td>{{ $invoice->remaining }}</td>
            <td>{{ $invoice->month }}</td>
            <td>{{ $invoice->year }}</td>







        </tr>
    @endforeach
    </tbody>
</table>
