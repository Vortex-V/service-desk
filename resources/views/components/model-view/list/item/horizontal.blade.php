@props(['column'])

<x-bs.list.item class="d-flex justify-content-between align-items-start">
    <div class="fw-bold">
        {{$column->getLabel()}}
    </div>
    <div class="text-end">
        {{$column->getValue()}}
    </div>
</x-bs.list.item>
