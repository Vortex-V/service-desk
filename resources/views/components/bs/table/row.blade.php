@props([
    'columns',
    'data'
])

<tr onclick="window.location='{{ route('') }}'">
    @foreach(array_keys($columns) as $name)
        <td>{{$data->$name}}</td>
    @endforeach
</tr>
