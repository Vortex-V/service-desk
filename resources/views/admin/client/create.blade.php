<?php

declare(strict_types=1);

use App\Models\User\Enum\UserRole;
use App\Models\Client\Client;

$title = 'Добавление клиента';
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
                            baseaction="clients"
                            :obj="null"
                            :buttons="[
                                ['label' => 'Сохранить', 'attributes' => ['type' => 'submit']]
                            ]"
                            formview="vertical"
                        >
                            <x-ls::text label="Название" name="name"/>
                        </x-ls::form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
