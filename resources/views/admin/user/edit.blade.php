<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\Client\Client;
use App\Models\User\User;

$title = "Редактирование пользователя {$user->id}";
?>

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
                            baseaction="users"
                            :obj="$user"
                            :buttons="[
                                ['label' => 'Сохранить', 'attributes' => ['type' => 'submit']]
                            ]"
                            formview="vertical"
                        >
                            <x-ls::email label="Email" name="email"/>

                            <x-ls::password label="Новый пароль" name="password"/>

                            <x-ls::select
                                label="Роль"
                                name="role"
                                :options="[null=>'Выберите'] + UserRole::labels()"
                                :value="$user->role->value"
                                placeholder="Выберите"
                            />

                            <x-ls::select
                                label="Клиент"
                                name="client_id"
                                :options="[null=>'Выберите'] + Client::all()
                                    ->mapWithKeys(fn (Client $client, int $key) => [$client->id => $client->name])
                                    ->toArray()"
                                :value="$user->client?->id"
                                placeholder="Выберите"
                            />
                        </x-ls::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
