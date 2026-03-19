<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covoit Application - Liste des employés</title>
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

        .page-title {
            color: white;
            font-size: 20px;
            margin: 0;
        }

        .employes-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .employes-table thead {
            background-color: #d4edda;
            font-weight: bold;
        }

        .employes-table thead th {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #4CAF50;
            color: #333;
        }

        .employes-table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .employes-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .employes-table tbody td {
            padding: 15px;
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

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
            font-size: 12px;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            color: #999;
        }
    </style>
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
