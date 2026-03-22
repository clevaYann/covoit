@extends('layouts.main')

@section('title','Détails de l\'employé')

@section('body')

<body>
    <div class="container">

        <a href="{{ route('employes.show', $voiture->employe->id) }}" class="btn-back">← Retour au profil</a>

        <div class="navbar">
            <a href="{{ route('employes.index') }}">Employés</a>
            <a href="{{ route('employes.show', $voiture->employe->id) }}#voitures">Voitures</a>
            <a href="#trajets">Trajets</a><br>
        </div><br>

        <div class="content-wrapper">
            <!-- Détails Voiture -->
            <div class="card">
                <div class="card-title">Voiture</div><br>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">Modèle: </span>
                        <span class="info-value">{{ $voiture->modele }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nb Place: </span>
                        <span class="info-value">{{ $voiture->nb_places }}</span>
                    </div><br>
                </div>
            </div>

            <!-- Informations Propriétaire -->
            <div class="card">
                <div class="card-title">Propriétaires</div>
                @include('partials.info-employes', ['employe' => $voiture->employe])
            </div>
            
    </div>
    <script src="{{ asset('js/vehicules.js') }}"></script>
</body>
</html>
@endsection