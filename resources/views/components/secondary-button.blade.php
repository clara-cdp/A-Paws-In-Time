<button {{ $attributes->merge(['type' => 'button', 'class' => 'go-button']) }}>
    {{ $slot }}
</button>
