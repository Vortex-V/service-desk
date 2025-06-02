<h2>Чат</h2>
<div class="mb-3">

    @canany(['is-manager', 'is-applicant', 'is-author'], $ticket)
        <x-ls::form
            :action="route('tickets.comments.store', $ticket)"
            :buttons="[
                ['label' => 'Отправить', 'attributes' => ['type' => 'submit']]
            ]"
            formview="vertical"
        >
            <x-ls::textarea name="body"/>

        </x-ls::form>
    @endcan

</div>

<div class="d-flex flex-column gap-2">

    @foreach($comments() as $comment)
        <div class="border border-gray-300 rounded-2 p-2">
            {{$comment->body}}
            <div class="d-flex justify-content-between">
                <span>
                    {{$comment->user->fullName}}
                </span>
                <span>
                    {{$comment->created_at->toDateTimeString()}}
                </span>
            </div>
        </div>
    @endforeach

</div>


