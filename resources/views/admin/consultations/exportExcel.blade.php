<table>
    <thead>
    <tr><th colspan="7">{{__('export.registerStudent')}}</th></tr>
    <tr>
        <th><b>{{__('export.STT')}}</b></th>
        <th><b>{{__('export.name')}}</b></th>
        <th><b>{{__('export.email')}}</b></th>
        <th><b>{{__('export.phone')}}</b></th>
        <th><b>{{__('export.year_of_birth')}}</b></th>
        <th><b>{{__('export.address')}}</b></th>
        <th><b>{{__('export.course')}}</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($consultations as $key=>$consultation)
        <tr>
            <th>{{ $key+1 }}</th>
            <td>{{ $consultation->name }}</td>
            <td>{{ $consultation->email }}</td>
            <td>{{ $consultation->phone }}</td>
            <td>{{ $consultation->year_of_birth }}</td>
            <td>{{ $consultation->address }}</td>
            <td>{{ !is_null($consultation->course) ?  $consultation->course->title : "" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>