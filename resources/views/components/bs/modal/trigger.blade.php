@props([
    'targetId',
    'action'
])

<button type="button" class="btn btn-outline-danger"
        data-bs-toggle="modal"
        data-bs-target="#{{ $targetId }}"
        data-action="{{ $action }}"
>
    {{ $slot }}
</button>
