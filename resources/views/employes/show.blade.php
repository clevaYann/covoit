<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covoit Application - Profil Employé</title>
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
            margin-bottom: 30px;
        }

        .profile-card {
            background-color: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .profile-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .profile-info {
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

        .verification-section {
            background-color: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        .form-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-button:hover {
            background-color: #45a049;
        }

        .verification-result {
            margin-top: 15px;
            padding: 15px;
            border-radius: 4px;
            display: none;
        }

        .verification-result.show {
            display: block;
        }

        .verification-result.yes {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .verification-result.no {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
            color: #721c24;
        }

        .vehicles-section {
            grid-column: 1 / -1;
            background-color: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .section-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .vehicles-table {
            width: 100%;
            border-collapse: collapse;
        }

        .vehicles-table thead {
            background-color: #d4edda;
        }

        .vehicles-table thead th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #4CAF50;
            color: #333;
            font-weight: bold;
        }

        .vehicles-table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .vehicles-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .vehicles-table tbody td {
            padding: 12px;
            color: #555;
        }

        .btn-voir {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-voir:hover {
            background-color: #45a049;
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

        .no-vehicles {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
        }

        .activity-section {
            margin-top: 15px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin: 5px 0;
        }

        .status-driver {
            background-color: #cfe9ff;
            color: #004085;
        }

        .status-not-driver {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Covoit Application</h1>
            <p>Employés / Voitures / Trajets / Campus</p>
        </div>

        <a href="{{ route('employes.index') }}" class="btn-back">← Retour à la liste</a>

        <div class="navbar">
            <a href="{{ route('employes.index') }}">Employés</a>
            <a href="#voitures">Voitures</a>
            <a href="#trajets">Trajets</a>
        </div>

        <div class="content-wrapper">
            <!-- Profil Employé -->
            <div class="profile-card">
                <div class="profile-title">Profil Employé</div>
                <div class="profile-info">
                    <div class="info-row">
                        <span class="info-label">Nom</span>
                        <span class="info-value">{{ $employe->nom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Prénom</span>
                        <span class="info-value">{{ $employe->prenom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $employe->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">NbVoiture</span>
                        <span class="info-value">{{ $employe->compterVoitures() }}</span>
                    </div>
                </div>
            </div>

            <!-- Vérification de Modèle -->
            <div class="verification-section">
                <div class="profile-title">Vérification Modèle</div>
                <div class="form-group">
                    <label class="form-label" for="modele">Modèle à chercher</label>
                    <input 
                        type="text" 
                        id="modele" 
                        class="form-input" 
                        placeholder="Ex: Kia, Toyota, BMW..."
                    >
                </div>
                <button class="form-button" onclick="verifierModele()">Vérifier</button>

                <div id="verificationResult" class="verification-result">
                    <!-- Le résultat s'affichera ici -->
                </div>
            </div>
        </div>

        <!-- Section Activité -->
        <div class="profile-card">
            <div class="profile-title">Activité</div>
            <div class="activity-section">
                <div>
                    <strong>Statut :</strong>
                    <div class="status-badge status-driver">{{ $employe->statutConducteur() }}</div>
                </div>
            </div>
        </div>

        <!-- Section Voitures -->
        <div class="vehicles-section" id="voitures">
            <div class="section-title">Voiture</div>

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

        <div class="footer">
            <p>Site développé par les BUT2</p>
        </div>
    </div>

    <script>
        function verifierModele() {
            const modele = document.getElementById('modele').value.trim();
            const resultDiv = document.getElementById('verificationResult');

            if (!modele) {
                resultDiv.classList.remove('show', 'yes', 'no');
                return;
            }

            // Récupérer le token CSRF depuis la meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("employes.show", $employe->id) }}/possede-modele', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ modele: modele })
            })
            .then(response => response.json())
            .then(data => {
                const result = data.possede ? 'YES' : 'NO';
                const resultClass = data.possede ? 'yes' : 'no';

                resultDiv.innerHTML = `<strong>Résultat :</strong> ${result}`;
                resultDiv.classList.add('show', resultClass);
            })
            .catch(error => {
                console.error('Erreur:', error);
                resultDiv.innerHTML = '<strong>Erreur lors de la vérification.</strong>';
                resultDiv.classList.add('show', 'no');
            });
        }

        // Permettre d'appuyer sur Entrée pour vérifier
        document.getElementById('modele').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                verifierModele();
            }
        });
    </script>
</body>
</html>
