<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covoit Application - Détails Voiture</title>
   
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Covoit Application</h1>
            <p>Employés / Voitures / Trajets / Campus</p>
        </div>

        <a href="{{ route('employes.show', $voiture->employe->id) }}" class="btn-back">← Retour au profil</a>

        <div class="navbar">
            <a href="{{ route('employes.index') }}">Employés</a>
            <a href="{{ route('employes.show', $voiture->employe->id) }}#voitures">Voitures</a>
            <a href="#trajets">Trajets</a>
        </div>

        <div class="content-wrapper">
            <!-- Détails Voiture -->
            <div class="card">
                <div class="card-title">Voiture</div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">Modèle</span>
                        <span class="info-value">{{ $voiture->modele }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nb Place</span>
                        <span class="info-value">{{ $voiture->nb_places }}</span>
                    </div>
                </div>
            </div>

            <!-- Informations Propriétaire -->
            <div class="card">
                <div class="card-title">Propriétaires</div>
                <div class="card-content">
                    <div class="info-row">
                        <span class="info-label">Nom</span>
                        <span class="info-value">{{ $voiture->employe->nom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Prénom</span>
                        <span class="info-value">{{ $voiture->employe->prenom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $voiture->employe->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NbVoiture</span>
                        <span class="info-value">{{ $voiture->employe->compterVoitures() }}</span>
                    </div>
                </div>
            </div>

            <!-- Section Activité -->
            <div class="card grid-full">
                <div class="card-title">Informations principales de {{ $voiture->employe->nom }}</div>
                <div class="card-content">
                    <div class="proprietaire-section">
                        <strong>Statut Conducteur :</strong>
                        <div class="status-badge status-available">
                            {{ $voiture->employe->statutConducteur() }}
                        </div>
                    </div>
                    <div class="proprietaire-section">
                        <strong>Voiture :</strong>
                        <div style="margin-top: 8px;">
                            <span class="status-badge status-available">
                                {{ $voiture->modele }} à chercher
                            </span>
                            <span class="status-badge status-available">
                                Vérifier
                            </span>
                        </div>
                    </div>
                    <div class="proprietaire-section">
                        <strong>Voir le profil :</strong>
                        <div style="margin-top: 8px;">
                            <a href="{{ route('employes.show', $voiture->employe->id) }}" class="proprietaire-link">
                                Visiter le profil de {{ $voiture->employe->prenom }} {{ $voiture->employe->nom }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Site développé par les BUT2</p>
        </div>
    </div>
</body>
</html>
