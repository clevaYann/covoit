 <!-- Informations sur l'employé -->
<div class="profile-card">
    <div class="profile-title">Information principales de M. {{ $employe->nom }}</div>
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