<div class="navbar">
    @if(isset($navItems))
        @foreach($navItems as $label => $url)
            <a href="{{ $url }}">{{ $label }}</a>
        @endforeach
    @else
        <a href="{{ route('employes.index') }}">Employés</a>
        <a href="#voitures">Voitures</a>
        <a href="#trajets">Trajets</a>
    @endif
</div>
