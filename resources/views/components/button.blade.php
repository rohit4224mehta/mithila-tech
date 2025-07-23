<button class="btn btn-{{ $type ?? 'primary' }} {{ $class ?? '' }}">
    {{ $slot }}
</button>

@component('components.button', ['type' => 'success', 'class' => 'w-100'])
    Save Changes
@endcomponent
