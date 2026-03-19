<style>
    .navbar {
        background-color: #e8f5e9;
        padding: 10px 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-size: 14px;
    }

    .navbar a {
        color: #333;
        text-decoration: none;
        margin-right: 30px;
        font-weight: bold;
    }

    .navbar a:hover {
        color: #4CAF50;
    }
</style>

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
