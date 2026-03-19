<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covoit Application - Profil Employé</title>
   
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
