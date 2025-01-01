<x-ls::hidden name="applicant_id" :value="$user->id"/>
<x-ls::select-model
    name="service_id"
    label="Сервис/Услуга"
    :options="$services"
    :translateCallback="static fn(\App\Models\Service\Service $obj) => [$obj->id, $obj->title]"
    :extra_options="[0 => 'Выберите сервис или услугу']"
/>
