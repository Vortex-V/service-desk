<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\Client\Client;
use App\Models\User\User;

/**
 * @var $user User
 */

$title = 'Создание пользователя';
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
                                ['label' => 'Далее', 'attributes' => ['type' => 'submit']]
                            ]"
                            formview="vertical"
                        >
                            <x-ls::email label="Email" name="email"/>

                            <x-ls::password label="Пароль" name="password"/>

                            <x-ls::select
                                label="Роль"
                                :options="[null=>'Выберите'] + UserRole::labels()"
                                placeholder="Выберите"
                            />

                            <x-ls::select
                                label="Клиент"
                                :options="[null=>'Выберите'] + Client::all()
                                    ->mapWithKeys(fn (Client $client, int $key) => [$client->id => $client->title])
                                    ->toArray()"
                                placeholder="Выберите"
                            />
                        </x-ls::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
