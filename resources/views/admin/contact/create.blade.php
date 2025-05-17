<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\Client\Client;
use App\Models\User\User;

/**
 * @var $user User
 */

$title = 'Создание контакта';
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
                            :action="route('users.contacts.store', [$user])"
                            :obj="null"
                            :buttons="[
                                ['label' => 'Сохранить', 'attributes' => ['type' => 'submit']]
                            ]"
                            formview="vertical"
                        >
                            <x-ls::hidden name="user_id" :value="$user->id"/>

                            <x-ls::text label="Фамилия" name="last_name"/>

                            <x-ls::text label="Имя" name="first_name"/>

                            <x-ls::text label="Отчество" name="patronymic"/>

                            <x-ls::text label="Телефон" name="phone"/>
                        </x-ls::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
