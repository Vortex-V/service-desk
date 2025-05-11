<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use App\View\Components\ModelView\Columns\ActionColumn;

$title = 'Пользователи';
?>
<x-layout.app :title="$title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>
                        <a href="{{route('users.create')}}" class="btn btn-primary float-end">Создать пользователя</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column gap-4">

{{--                            <x-ls::form
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
                            </x-ls::form>--}}

                            <x-model-view.table
                                :data="$usersPaginator"
                                :settings="[
                                    [
                                        'attribute' => 'id',
                                        'label' => 'ID',
                                    ],
                                    [
                                        'attribute' => 'email',
                                        'label' => 'Email',
                                    ],
                                    [
                                        'attribute' => 'role',
                                        'value' => static fn(User $user) => UserRole::label($user->role),
                                        'label' => 'Роль',
                                    ],
                                    [
                                        'attribute' => 'fullName',
                                        'label' => 'ФИО',
                                    ],
                                    [
                                        'attribute' => 'client.name',
                                        'label' => 'Клиент',
                                    ],
                                    [
                                        'class' => ActionColumn::class,
                                        'action' => static fn(User $user) => view('components.model-view.grid.actions.show', [
                                            'url' => route('users.show', [$user]),
                                        ]),
                                    ],
                                ]"
                            />

                            {{ $usersPaginator->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
