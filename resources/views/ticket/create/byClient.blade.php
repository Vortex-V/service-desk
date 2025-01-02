<x-ls::hidden name="applicant_id" :value="$user->id"/>

@php
    $serviceOptions = $services->mapWithKeys(fn(array $item) => [$item['id']=>$item['title']])->prepend('Выберите сервис или услугу', 0);
@endphp
<x-ls::select
    name="service_id"
    label="Сервис/Услуга"
    :options="$serviceOptions"
/>
