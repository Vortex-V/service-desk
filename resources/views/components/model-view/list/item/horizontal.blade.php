@props(['column'])

<x-bs.list.item class="d-flex justify-content-between align-items-start">
    <div class="me-auto fw-bold">
        {{$column->getLabel()}}
    </div>
    {{$column->getValue()}}
</x-bs.list.item>
