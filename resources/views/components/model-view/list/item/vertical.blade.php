@props(['column'])

<x-bs.list.item>
    <div class="me-auto fw-bold">
        {{$column->getLabel()}}
    </div>
    {{$column->getValue()}}
</x-bs.list.item>
