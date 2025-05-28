<?php

declare(strict_types=1);

use App\Models\Client\Client;
use App\View\Components\ModelView\Attributes;

/**
 * @var Client $client
 */

$title = "Клиент {$client->id}";
?>
<x-layout.app :title="$title">

    <div class="container">
        <div class="row justify-content-center row-gap-3">
            <div class="col-12 col-md-8 col-lg-4 d-flex flex-column gap-1">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-1">
                    <x-ls::link
                        :href="route('clients.edit', [$client])"
                        label="Редактировать"
                    />
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-model-view.attributes
                            :data="$client"
                            :settings="[
                                    [
                                        'attribute' => 'id',
                                        'label' => 'ID',
                                    ],
                                    [
                                        'attribute' => 'name',
                                        'label' => 'Название',
                                    ],
                            ]"
                            :column-view="Attributes::COLUMN_VIEW_VERTICAL"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
