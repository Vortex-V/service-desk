@props([
    'id',
    'action',
    'method',
    'title',
    'text',
    'closeText',
    'acceptText',
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ "$id-label" }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ "$id-label" }}">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                {{ $text }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $closeText }}</button>
                <form action="{{ $action ?? '' }}" method="{{ in_array($method, ['POST', 'GET'], true) ? $method : 'POST' }}">
                    @csrf
                    @method($method)
                    <button type="submit" class="btn btn-outline-success">
                        {{ $acceptText }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
