<button {{ $attributes->merge(['type' => 'submit', 'class' => 'go-button']) }}>
    {{ $slot }}
</button>
