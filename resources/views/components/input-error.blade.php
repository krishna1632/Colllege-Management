@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-danger']) }}>
        @foreach ((array) $messages as $message)
            <strong>{{ $message }}</strong>
        @endforeach
    </div>
@endif
