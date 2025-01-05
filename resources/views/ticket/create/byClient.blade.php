<x-ls::hidden name="applicant_id" :value="$user->id"/>

@php
    $serviceOptions = [null=>'Выберите сервис или услугу']+$services->mapWithKeys(fn(array $item) => [$item['id']=>$item['title']])->toArray();
@endphp
<x-ls::select
    name="service_id"
    label="Сервис/Услуга"
    :options="$serviceOptions"
/>
