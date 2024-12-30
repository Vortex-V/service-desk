@props([
       'columns',
])

<thead>
    @foreach($columns as $label)
        <th>{{ $label }}</th>
    @endforeach
</thead>
