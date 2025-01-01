<div
    x-data="{
                                    clientId: 0,
                                    services: {{ Js::from($services) }},
                                    usersByClientId: {{ Js::from($usersByClientId) }},
                                    get clientServices() {
                                        const clientId = this.clientId;
                                        return this.services.filter(function(s) {
                                            for (var id of s.clientIds) {
                                                if (id == clientId) {
                                                    return true;
                                                }
                                            }
                                            return false;
                                        });
                                    },
                                    get clientUsers() {
                                      return this.usersByClientId[this.clientId] || [];
                                    },
                                }"
>
    <x-ls::select-model label="Клиент"
                        :options="$clients"
                        :translateCallback="static fn(App\Models\Client\Client $obj) => [$obj->id, $obj->name]"
                        :extra_options="[0 => 'Выберите клиента']"
                        x-model="clientId"
    />

    <x-bs.form.select
        name="applicant_id"
        label="Заявка от">
        <template x-for="user in clientUsers">
            <option x-bind:value="user.id" x-text="user.name"></option>
        </template>
    </x-bs.form.select>

    <x-bs.form.select
        name="service_id"
        label="Сервис/Услуга"
    >
        <template x-for="service in clientServices">
            <option x-bind:value="service.id" x-text="service.title"></option>
        </template>
    </x-bs.form.select>
</div>
