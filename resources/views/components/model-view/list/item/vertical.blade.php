@props(['column'])

<x-bs.list.item>
    <div class="fw-bold">
        {{$column->getLabel()}}
    </div>
    {{$column->getValue()}}
</x-bs.list.item>
