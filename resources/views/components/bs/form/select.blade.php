@props([
    'name',
    'label',
    'id',
])

@php
    $id ??= $name;
@endphp

<div class="mb-3">
    <label for="{{$id}}">{{$label}}</label>
    <select id="{{$id}}" name="{{$name}}" {{$attributes->toHtml()}} class="form-select">
        {{ $slot }}
    </select>
</div>
