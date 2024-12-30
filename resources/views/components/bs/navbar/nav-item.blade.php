@props([
    'url',
])

<li class="nav-item">
    <a @class([
            'nav-link',
            'active' => url()->current() === $url,
        ])
       href="{{ $url }}">
        {{ $slot }}
    </a>
</li>
