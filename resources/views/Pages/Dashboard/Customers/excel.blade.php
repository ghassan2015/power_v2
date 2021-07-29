<table>
    <thead>
    <tr style="color: red">
        <th style="color: red">اسم المشترك</th>
        <th style="color: red">الايميل</th>
        <th style="color: red">الهاتف </th>
        <th style="color: red">العنوان </th>
        <th style="color: red">سعر الكليو واط</th>
    </tr>
    </thead>
    <tbody>
    @foreach($Customers as $Customer)
        <tr>
            <td>{{ $Customer->full_name }}</td>
            <th>{{$Customer->email}}</th>
            <td>{{ $Customer->mobile }}</td>
            <td>{{ $Customer->location }}</td>
            <td>{{ $Customer->kw_price }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
