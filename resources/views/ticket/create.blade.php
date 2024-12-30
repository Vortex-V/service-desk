@php

    use App\Models\Ticket\Ticket;

    $title = 'Создание заявки';
    $ticket = new Ticket();
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
                            route="tickets.store"
                            :obj="$ticket"
                            :buttons="[
                                ['color' => 'primary', 'label' => 'Сохранить', 'attributes' => ['type' => 'submit']]
                            ]"
                        >

                        </x-ls::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
