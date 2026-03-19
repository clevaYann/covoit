<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covoit Application - Détails Voiture</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

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

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .card {
            background-color: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .card-content {
            background-color: #e3f2fd;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #4CAF50;
        }

        .info-row {
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 3px;
        }

        .info-value {
            color: #333;
            margin-left: 5px;
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            margin: 5px 0;
        }

        .status-available {
            background-color: #d4edda;
            color: #155724;
        }

        .status-unavailable {
            background-color: #f8d7da;
            color: #721c24;
        }

        .proprietaire-section {
            margin: 15px 0;
        }

        .proprietaire-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .proprietaire-link:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }

        .grid-full {
            grid-column: 1 / -1;
        }
    </style>
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
