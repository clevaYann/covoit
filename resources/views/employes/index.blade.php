@extends('layouts.main')

@section('tilte','Liste des employés')

@section('body')

<body>
    <div class="container">
        <div class="header">
            <p>Liste des employés</p>
        </div>

        @if($employe->count() > 0)
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
                    @foreach ($employe as $employe)
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
    </div>
</body>

@endsection