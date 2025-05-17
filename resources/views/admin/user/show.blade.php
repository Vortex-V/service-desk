<?php

declare(strict_types=1);

use App\Models\User\User;
use App\Models\User\Enum\UserRole;

$title = "Пользователь {$user->id}";
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
                        :href="route('users.edit', [$user])"
                        label="Редактировать"
                    />
                    <x-ls::link
                        :href="route('users.contacts.edit', [$user, $user->contact])"
                        label="Редактировать контакт"
                    />
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <x-model-view.attributes
                            :data="$user"
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
                                    'attribute' => 'client.name',
                                    'label' => 'Клиент',
                                ],
                            ]"
                            :column-view="\App\View\Components\ModelView\Attributes::COLUMN_VIEW_VERTICAL"
                        />
                        <h3 class="mt-3">Контактные данные</h3>
                        <x-model-view.attributes
                            :data="$user->contact"
                            :settings="[
                                [
                                    'attribute' => 'last_name',
                                    'label' => 'Фамилия',
                                ],
                                [
                                    'attribute' => 'first_name',
                                    'label' => 'Имя',
                                ],
                                [
                                    'attribute' => 'patronymic',
                                    'label' => 'Отчество',
                                ],
                                [
                                    'attribute' => 'phone',
                                    'label' => 'Номер телефона',
                                ],
                            ]"
                            :column-view="\App\View\Components\ModelView\Attributes::COLUMN_VIEW_VERTICAL"
                        />
                    </div>
                </div>
            </div>
        </div>
</div>

</x-layout.app>
