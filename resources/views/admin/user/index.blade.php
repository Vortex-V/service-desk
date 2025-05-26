<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use App\View\Components\ModelView\Columns\ActionColumn;
use App\Models\Client\Client;

$title = 'Пользователи';
?>
<x-layout.app :title="$title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3 d-flex flex-column gap-1">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>
                        <a href="{{route('users.create')}}" class="btn btn-primary float-end">Создать пользователя</a>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-1">
                    <a href="{{route('users.import')}}" class="btn btn-primary mb-1">Импорт пользователей</a>
                    <a href="{{route('users.export-collection', session()->getOldInput())}}" class="btn btn-primary mb-1">Скачать XLSX</a>
{{--                    <x-ls::form--}}
{{--                        action="{{route('users.export-collection', session()->getOldInput())}}"--}}
{{--                        buttons_align="start"--}}
{{--                        :buttons="[--}}
{{--                                ['label' => 'Скачать XLSX', 'attributes' => ['type' => 'submit'], 'color' => 'primary']--}}
{{--                            ]"--}}
{{--                    />--}}
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

                                <x-ls::email
                                    label="Email"
                                    name="email"
                                    :value="old('email')"
                                />

                                <x-ls::select
                                    label="Роль"
                                    name="role"
                                    :options="[null=>'Выберите'] + UserRole::labels()"
                                    :value="old('role')"
                                    placeholder="Выберите"
                                />

                                <x-ls::select
                                    label="Клиент"
                                    name="client_id"
                                    :options="[null=>'Выберите'] + Client::all()
                                        ->mapWithKeys(fn (Client $client, int $key) => [$client->id => $client->name])
                                        ->toArray()"
                                    :value="old('client_id')"
                                    placeholder="Выберите"
                                />
                            </x-ls::form>

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
