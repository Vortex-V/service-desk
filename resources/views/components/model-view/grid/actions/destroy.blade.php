@props([
    'url'
])

<x-bs.modal.trigger
    targetId="modal-destroy"
    :action="$url"
>
    <i class="bi bi-trash"></i>
</x-bs.modal.trigger>
