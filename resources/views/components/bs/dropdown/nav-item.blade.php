<?php

declare(strict_types=1);
?>

@props([
    'label'
])

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $label }}
    </a>
    <ul class="dropdown-menu">
        {{ $slot }}
    </ul>
</li>
