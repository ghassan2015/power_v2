<table>
    <thead>
    <tr style="color: red">
        <th style="color: red">رقم الفاتورة</th>
        <th style="color: red">اسم المشترك</th>
        <th style="color: red">الدفعة </th>
        <th style="color: red">دورة الفاتورة</th>
        <th style="color: red">المحصل</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Payments as $payment)
        <tr>
            <td>{{ $payment->payment_no }}</td>
            <td>{{ $payment->Invoice->Customer->full_name }}</td>
            <th>{{$payment->payment_value}}</th>
            <td>{{$payment->Invoice->insertion_date }}</td>
            <td>{{ $payment->User->name }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
