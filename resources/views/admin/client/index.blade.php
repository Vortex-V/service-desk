<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use App\View\Components\ModelView\Columns\ActionColumn;
use App\Models\Client\Client;

$title = 'Клиенты';
?>
<x-layout.app :title="$title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3 d-flex flex-column gap-1">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>
                        <a href="{{route('clients.create')}}" class="btn btn-primary float-end">Добавить клиента</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column gap-4">

                            <x-ls::form
                                method="get"
                                formview="inline"
                                :buttons="[
                                    ['label' => 'Поиск']
                                ]"
                            >
                                <x-ls::text
                                    label="ID"
                                    name="id"
                                    :value="old('id')"
                                />

                                <x-ls::text
                                    label="Название"
                                    name="name"
                                    :value="old('name')"
                                />
                            </x-ls::form>

                            <x-model-view.table
                                :data="$clientsPaginator"
                                :settings="[
                                    [
                                        'attribute' => 'id',
                                        'label' => 'ID',
                                    ],
                                    [
                                        'attribute' => 'name',
                                        'label' => 'Название',
                                    ],
                                    [
                                        'class' => ActionColumn::class,
                                        'action' => static fn(Client $client) => view('components.model-view.grid.actions.show', [
                                            'url' => route('clients.show', [$client]),
                                        ]),
                                    ],
                                    [
                                        'class' => ActionColumn::class,
                                        'action' => static fn(Client $client) => view('components.model-view.grid.actions.destroy', [
                                            'url' => route('clients.destroy', [$client]),
                                        ]),
                                    ],
                                ]"
                            />

                            {{ $clientsPaginator->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-bs.modal.alert
        id="modal-destroy"
        method="DELETE"
        title="Удалить клиента?"
        text="Клиент будет удалён."
        closeText="Отмена"
        acceptText="Подтвердить"
    />
</x-layout.app>
