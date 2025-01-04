<x-bs.table.table>
    <thead>
        @foreach($labels() as $label)
            <th>{{$label}}</th>
        @endforeach
    </thead>
    <tbody>
        @foreach($models() as $model)
            <tr>
                @foreach($columns($model) as $column)
                    @if($column instanceof \App\View\Components\ModelView\Columns\ActionColumn)
                        <td>{!! $column->getValue() !!}</td>
                    @else
                        <td>{{ $column->getValue() }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</x-bs.table.table>
