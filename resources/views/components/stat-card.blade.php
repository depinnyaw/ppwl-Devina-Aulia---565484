
@props([
    'title',
    'value',
    'description',
    'icon' => 'P',
    'color' => 'blue',
])

@php
    $colors = [
        'blue' => [
            'background' => 'bg-blue-50',
            'text' => 'text-blue-600',
        ],
        'green' => [
            'background' => 'bg-green-50',
            'text' => 'text-green-600',
        ],
        'yellow' => [
            'background' => 'bg-yellow-50',
            'text' => 'text-yellow-600',
        ],
    ];

    $selectedColor = $colors[$color] ?? $colors['blue'];
@endphp

<div class="bg-white rounded-2xl border border-gray-200 p-7 shadow-sm">
    <div class="flex items-center justify-between">
        <p class="text-sm font-medium text-gray-500">
            {{ $title }}
        </p>

        <div class="{{ $selectedColor['background'] }} {{ $selectedColor['text'] }} w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold">
            {{ $icon }}
        </div>
    </div>

    <h3 class="text-3xl font-bold text-gray-900 mt-6">
        {{ $value }}
    </h3>

    <p class="text-sm text-gray-500 mt-1">
        {{ $description }}
    </p>
</div>
