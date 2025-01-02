@php
    declare(strict_types=1)
@endphp

@use(Illuminate\Database\Eloquent\Builder)
@use(Illuminate\Support\Facades\Gate)

@php
    $title = 'Создание заявки';
    $user = auth()->user();

    $canSelectClient = $user->can('select-client', \App\Models\Ticket\Ticket::class);
@endphp

<x-layout.app :title="$title">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-ls::form
                            baseaction="tickets"
                            :obj="null"
                            :buttons="[
                                ['label' => 'Сохранить', 'attributes' => ['type' => 'submit']]
                            ]"
                            formview="vertical"
                        >
                            @if($user->isManager())
                                @include('ticket.create.byManager', compact('clients', 'services', 'usersByClientId'))
                            @else
                                @include('ticket.create.byClient')
                            @endif

                            <x-ls::select-model label="Тип заявки" name="type_id"
                                                :options="\App\Models\Ticket\TicketType::all()"
                                                :translateCallback="static fn(\App\Models\Ticket\TicketType $obj) => [$obj->id, $obj->title]"
                            />
                            <x-ls::select-model label="Приоритет" name="priority_id"
                                                :options="\App\Models\Ticket\TicketPriority::all()"
                                                :translateCallback="static fn(\App\Models\Ticket\TicketPriority $obj) => [$obj->id, $obj->title]"
                            />
                            <x-ls::textarea name="description" label="Описание"/>
                        </x-ls::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
