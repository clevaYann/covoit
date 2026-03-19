<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="page-title">Liste des employés</h1>
    <table class="employes-tables">
    <thead>
        <tr>
            <th>Nom: </th>
            <th>Prénom: </th>
            <th>Email: </th>
            <th>Action: </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($employes as $employe)
            <tr>
                <td>{{ $employe->nom }}</td>
                <td>{{ $employe->prenom }}</td>
                <td>{{ $employe->email }}</td>
                <td>
                    <a href="{{ route('employes.show', $employe->id) }}">Voir</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Aucun employé trouvé.</td>
            </tr>
        @endforelse
    </tbody>
    </table>
</body>
</html>
