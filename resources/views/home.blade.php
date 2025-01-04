<x-layout.app title="Мои заявки">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>Мои заявки</h1>
                        @unless(Gate::allows('admin'))
                            <a href="{{route('tickets.create')}}" class="btn btn-primary float-end">Создать заявку</a>
                        @endunless
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-grid-view
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
                                'value' => [\App\Models\Ticket\Ticket::class, 'getStatusLabel'],
                                'label' => 'Статус',
                            ],
                            [
                                'attribute' => 'applicant.contact.fullName',
                                'label' => 'Заявка от',
                            ],
                            [
                                'attribute' => 'manager.contact.fullName',
                                'label' => 'Менеджер',
                            ],
                            [
                                'class' => \App\View\Components\ModelView\Columns\ActionColumn::class,
                                'action' => fn(\App\Models\Ticket\Ticket $ticket) => view('components.model-view.grid.actions.show', [
                                    'url' => route('tickets.show', [$ticket]),
                                ]),
                            ],
                        ]"
                        />

                        {{ $ticketsPaginator->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
