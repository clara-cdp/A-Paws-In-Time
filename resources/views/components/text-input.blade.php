@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-2 border-orange-800 focus:border-teal-200 focus:ring-blue-500 shadow-sm']) }}>
