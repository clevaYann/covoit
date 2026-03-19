<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covoit Application - Liste des employés</title>
    
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Covoit Application</h1>
            <p class="page-title">Liste des employés</p>
        </div>

        @if($employes->count() > 0)
            <table class="employes-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employes as $employe)
                        <tr>
                            <td>{{ $employe->nom }}</td>
                            <td>{{ $employe->prenom }}</td>
                            <td>{{ $employe->email }}</td>
                            <td>
                                <a href="{{ route('employes.show', $employe->id) }}" class="btn-voir">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                <p>Aucun employé trouvé.</p>
            </div>
        @endif

        <div class="footer">
            <p>Site développé par les BUT2</p>
        </div>
    </div>
</body>
</html>
