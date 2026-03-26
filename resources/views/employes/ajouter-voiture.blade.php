@extends('layouts.main')

@section('title', 'Ajouter une voiture')

@section('body')
<body>
    <div class="container">
        <div class="header">
            <p>Aucune voiture trouvée pour cet employé</p>
        </div>

        <a href="{{ route('employes.index') }}" class="btn-back">← Retour à la liste</a>

        <div class="profile-card">
            <div class="profile-title">Ajouter une voiture pour {{ $employe->nom }} {{ $employe->prenom }}</div>
            <div class="profile-info">
                <form action="{{ route('vehicules.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="employe_id" value="{{ $employe->id }}">

                    <div class="info-row">
                        <label for="modele" class="info-label">Modèle:</label>
                        <input type="text" id="modele" name="modele" required>
                    </div>

                    <div class="info-row">
                        <label for="nb_places" class="info-label">Nombre de places:</label>
                        <input type="number" id="nb_places" name="nb_places" min="1" required>
                    </div>

                    <div class="info-row">
                        <button type="submit" class="btn-voir">Ajouter la voiture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection
