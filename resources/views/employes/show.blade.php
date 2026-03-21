@extends('layouts.main')

@section('title','Détails de l\'employé')

@section('body')

<body>
    <div class="container">
        <div class="header">
            <p>Employés / Voitures / Trajets / Campus</p>
        </div>

        <a href="{{ route('employes.index') }}" class="btn-back">← Retour à la liste</a>

        <div class="navbar">
            <a href="{{ route('employes.index') }}">Employés</a>
            <a href="#voitures">Voitures</a>
            <a href="#trajets">Trajets</a>
        </div>
        <br>

        <div class="content-wrapper">
            <!-- Profil Employé -->
                @include('partials.info-employes')
                <div id="verificationResult" class="verification-result">
                    <!-- Le résultat s'affichera ici -->
                </div>
            </div>
        </div>

        <!-- Section Activité -->
        <div class="profile-card">
            <div class="profile-title">Activité</div><br>
            <div class="activity-section">
                <div>
                    <div class="status-badge status-driver">Statut: {{ $employe->statutConducteur() }}</div><br>
                </div>
            </div>
        </div>

        <!-- Section Voitures -->
        <form id="verificationForm" class="verification-form">
            <div class="form-group">
                <label for="verificationInput">Voiture</label>
                <input type="text" id="verificationInput" name="verificationInput" placeholder="Modele a rechercher">
                <button type="submit" class="btn-verify">Vérifier</button>
         <!-- resultat de la verification -->
                <div id="verificationResult" class="verification-result">
                    <!-- Le résultat s'affichera ici -->
                </div>
            </div>
        </form>
         

            @if($employe->voitures->count() > 0)
                <table class="vehicles-table">
                    <thead>
                        <tr>
                            <th>Modèle</th>
                            <th>Nb Place</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employe->voitures as $voiture)
                            <tr>
                                <td>{{ $voiture->modele }}</td>
                                <td>{{ $voiture->nb_places }}</td>
                                <td>
                                    <a href="{{ route('vehicules.show', $voiture->id) }}" class="btn-voir">Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no-vehicles">
                    Cet employé n'a pas de voiture enregistrée.
                </div>
            @endif
        </div>
    </div>
</body>
    

@endsection