@if (isset($data))
    <script>
        window.filamentData = @js($data)
    </script>
@endif

{{-- Charger le CSS de Blade UI Kit pour Pickr --}}
@bukStyles('color-picker')

@foreach ($assets as $asset)
    @if (! $asset->isLoadedOnRequest())
        {{ $asset->getHtml() }}
    @endif
@endforeach

<style>
    :root {
        @foreach ($cssVariables ?? [] as $cssVariableName => $cssVariableValue)
            --{{ $cssVariableName }}:{{ $cssVariableValue }};
    @endforeach
}
</style>

{{-- Charger le JS de Blade UI Kit pour Pickr --}}
@bukScripts('color-picker')
