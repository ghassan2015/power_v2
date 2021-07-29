<table>
    <thead>
    <tr style="color: red">
        <th style="color: red"> اسم المصاريف</th>
        <th style="color: red">نوع المصاريف</th>
        <th style="color: red">قيمة الاجمالية </th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $Expense)
        <tr>
            <td>{{ $Expense->name }}</td>
            <th>{{$Expense->Option->name}}</th>
            <td>{{ $Expense->price_expenses }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
