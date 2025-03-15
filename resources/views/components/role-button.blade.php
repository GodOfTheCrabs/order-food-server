@props(['roles', 'buttonText', 'route', 'buttonClass', 'icon', 'method'])

    {{-- <a href="{{ $route }}" class="{{ $buttonClass }}">
        @if($icon)
            <i class="{{ $icon }}"></i> <!-- Иконка перед текстом -->
        @endif
        @if($buttonText)
            {{ $buttonText }} <!-- Текст кнопки -->
        @endif
    </a> --}}

@if ($method)
    <form action="{{ $route }}" method="POST" onsubmit="return confirmDelete();">
        @csrf
        @method($method)
        <button type="submit" class="{{ $buttonClass }}">
            @if($icon)
                <i class="{{ $icon }}"></i>
            @endif
            @if($buttonText)
                {{ $buttonText }}
            @endif
        </button>
    </form>
@else
    <a href="{{ $route }}" class="{{ $buttonClass }}">
        @if($icon)
            <i class="{{ $icon }}"></i>
        @endif
        @if($buttonText)
            {{ $buttonText }}
        @endif
    </a>
@endif