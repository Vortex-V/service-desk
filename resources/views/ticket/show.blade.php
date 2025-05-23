@php
    declare(strict_types=1)
@endphp

@use(App\Models\Ticket\Ticket)

@php
    $title = "Заявка {$ticket->id}";
    $user = auth()->user();

    $ticket->created_at;
@endphp

<x-layout.app :title="$title">

    <div class="container">
        <div class="row justify-content-center row-gap-3">
            <div class="col-12 col-md-8 col-lg-3 d-flex flex-column gap-1">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>

                        <x-model-view.attributes
                            :data="$ticket"
                            :settings="[
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
                                    'attribute' => 'author.fullName',
                                    'label' => 'Автор',
                                ],
                                [
                                    'attribute' => 'manager.fullName',
                                    'label' => 'Менеджер',
                                ],
                                [
                                    'attribute' => 'created_at.toDateTimeString',
                                    'label' => 'Создана',
                                ],
                                [
                                    'attribute' => 'updated_at.toDateTimeString',
                                    'label' => 'Последнее изменение',
                                ],
                            ]"
                        />
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-1">
                    @if(Gate::allows('status-to-work', $ticket))
                        <x-ls::form action="{{route('tickets.to-work', [$ticket])}}"
                                    buttons_align="start"
                                    :buttons="[
                                ['label' => 'Взять в работу', 'attributes' => ['type' => 'submit'], 'color' => 'success']
                            ]"
                        />
                    @endif
                    @if(Gate::allows('status-to-closed', $ticket))
                        <x-ls::form action="{{route('tickets.close', [$ticket])}}"
                                    buttons_align="start"
                                    :buttons="[
                                ['label' => 'Закрыть', 'attributes' => ['type' => 'submit'], 'color' => 'success']
                            ]"
                        />
                    @endif
                    @if(Gate::allows('status-to-rejected', $ticket))
                        <x-ls::form action="{{route('tickets.reject', [$ticket])}}"
                                    buttons_align="start"
                                    :buttons="[
                                ['label' => 'Отклонить', 'attributes' => ['type' => 'submit'], 'color' => 'danger']
                            ]"
                        />
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-model-view.attributes
                            :data="$ticket"
                            :settings="[
                                [
                                    'attribute' => 'applicant.fullName',
                                    'label' => 'Заявка от',
                                ],
                                [
                                    'attribute' => 'client.name',
                                    'label' => 'Клиент',
                                ],
                                [
                                    'attribute' => 'applicant.email',
                                    'label' => 'Электронная почта',
                                ],
                                [
                                    'attribute' => 'applicant.contact.phone',
                                    'label' => 'Номер телефона',
                                ],
                                [
                                    'attribute' => 'description',
                                    'label' => 'Описание',
                                ],
                            ]"
                            :column-view="\App\View\Components\ModelView\Attributes::COLUMN_VIEW_VERTICAL"
                        />
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-chat
                            :$ticket
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
