@php
/**
 * @var \App\View\Components\View\Column $column
 */
@endphp

<x-bs.list.group class="list-group-flush">
    @foreach($columns() as $column)
        <x-dynamic-component :component="$columnViewName" :column="$column"/>
    @endforeach
</x-bs.list.group>
