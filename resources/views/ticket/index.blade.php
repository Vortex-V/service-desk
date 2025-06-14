@use(App\Models\Ticket\Ticket)
@use(App\View\Components\ModelView\Columns\ActionColumn)

<div class="d-flex flex-column gap-4">

<x-ls::form
    method="get"
    formview="inline"
    :buttons="[
        ['label' => 'Поиск']
    ]"
>
    <x-ls::select
        label="Тип"
        name="type_id"
        :value="old('type_id')"
        :options="[null=>'Тип']+$ticketTypes"
    />
    <x-ls::select
        label="Приоритет"
        name="priority_id"
        :value="old('priority_id')"
        :options="[null=>'Приоритет']+$ticketPriorities"
    />
    <x-ls::select
        label="Статус"
        name="status"
        :value="old('status')"
        :options="[null=>'Статус']+$ticketStatuses"
    />
    <x-ls::select
        label="Клиент"
        name="client_id"
        :value="old('client_id')"
        :options="[null=>'Клиент']+$clients"
    />
</x-ls::form>

<x-model-view.table
    :data="$ticketsPaginator"
    :settings="[
                            [
                                'attribute' => 'id',
                                'label' => 'ID',
                            ],
                            [
                                'attribute' => 'type.title',
                                'label' => 'Тип',
                            ],
                            [
                                'attribute' => 'priority.title',
                                'label' => 'Приоритет',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => [Ticket::class, 'getStatusLabel'],
                                'label' => 'Статус',
                            ],
                            [
                                'attribute' => 'client.name',
                                'label' => 'Клиент',
                            ],
                            [
                                'attribute' => 'manager.fullName',
                                'label' => 'Менеджер',
                            ],
                            [
                                'class' => ActionColumn::class,
                                'action' => static fn(Ticket $ticket) => view('components.model-view.grid.actions.show', [
                                    'url' => route('tickets.show', [$ticket]),
                                ]),
                            ],
                            [
                                'class' => ActionColumn::class,
                                'action' => static fn(Ticket $ticket) => view('components.model-view.grid.actions.destroy', [
                                    'url' => route('tickets.destroy', [$ticket]),
                                ]),
                            ],
                        ]"
/>

{{ $ticketsPaginator->links() }}

</div>

<x-bs.modal.alert
    id="modal-destroy"
    method="DELETE"
    title="Удалить заявку?"
    text="Заявка будет удалена."
    closeText="Отмена"
    acceptText="Подтвердить"
/>
