<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <h1 href="{{ route('employes.index') }}" class='page-title'>Listes des employes</h1>
    <table class="employes-tables">
    <thead>
        <tr>
            <th>Nom: </th>
            <th>Prénom: </th>
            <th>Email: </th>
            <th>Action: </th>
        </tr>
    </thead>   
    </table>
</body>
</html>
