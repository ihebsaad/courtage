@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mandat_immo_2']) }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Informations du client (Mandant)</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Civilité Client 1</label>
                        <select name="civilite_client1" class="form-control" required>
                            <option value="Monsieur" {{ ($data['civilite_client1'] ?? '') === 'Monsieur' ? 'selected' : '' }}>Monsieur</option>
                            <option value="Madame" {{ ($data['civilite_client1'] ?? '') === 'Madame' ? 'selected' : '' }}>Madame</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nom Client 1</label>
                        <input type="text" name="nom_client1" class="form-control" value="{{ $data['nom_client1'] ?? $client->nom }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Prénom Client 1</label>
                        <input type="text" name="prenom_client1" class="form-control" value="{{ $data['prenom_client1'] ?? $client->prenom }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Adresse Client 1</label>
                        <input type="text" name="adresse_client1" class="form-control" value="{{ $data['adresse_client1'] ?? $client->adresse_complete }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance Client 1</label>
                        <input type="date" name="date_naissance_client1" class="form-control" value="{{ $data['date_naissance_client1'] ?? ($client->date_naissance ? $client->date_naissance->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <hr>
                <h6>Client 2 (optionnel - si couple)</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Civilité Client 2</label>
                        <select name="civilite_client2" class="form-control">
                            <option value="">-- Non applicable --</option>
                            <option value="Monsieur" {{ ($data['civilite_client2'] ?? '') === 'Monsieur' ? 'selected' : '' }}>Monsieur</option>
                            <option value="Madame" {{ ($data['civilite_client2'] ?? '') === 'Madame' ? 'selected' : '' }}>Madame</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nom Client 2</label>
                        <input type="text" name="nom_client2" class="form-control" value="{{ $data['nom_client2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Prénom Client 2</label>
                        <input type="text" name="prenom_client2" class="form-control" value="{{ $data['prenom_client2'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Adresse Client 2</label>
                        <input type="text" name="adresse_client2" class="form-control" value="{{ $data['adresse_client2'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance Client 2</label>
                        <input type="date" name="date_naissance_client2" class="form-control" value="{{ $data['date_naissance_client2'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Projet de financement</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Montant du crédit immobilier (€)</label>
                        <input type="number" name="montant_credit" class="form-control" value="{{ $data['montant_credit'] ?? '' }}" step="0.01">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Apport personnel (€)</label>
                        <input type="number" name="apport_personnel" class="form-control" value="{{ $data['apport_personnel'] ?? '' }}" step="0.01">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Objet du financement</label>
                        <input type="text" name="objet_financement" class="form-control" value="{{ $data['objet_financement'] ?? 'Achat' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Destination</label>
                        <input type="text" name="destination" class="form-control" value="{{ $data['destination'] ?? 'Achat résidence principale sans travaux' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Informations conseiller</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Nom du conseiller</label>
                        <input type="text" name="nom_conseiller" class="form-control" value="{{ $data['nom_conseiller'] ?? 'Raphaël JACOB' }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Dates du mandat</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Fait à</label>
                        <input type="text" name="fait_a" class="form-control" value="{{ $data['fait_a'] ?? 'Paris' }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Date de début du mandat</label>
                        <input type="date" name="date_debut_mandat" class="form-control" value="{{ $data['date_debut_mandat'] ?? now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Date de fin du mandat</label>
                        <input type="date" name="date_fin_mandat" class="form-control" value="{{ $data['date_fin_mandat'] ?? now()->addMonths(3)->format('Y-m-d') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Rémunération</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Montant des honoraires (€)</label>
                        <input type="number" name="montant_honoraires" class="form-control" value="{{ $data['montant_honoraires'] ?? '' }}" step="0.01">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-download"></i> Télécharger en PDF
            </button>
            <a href="{{ route('clients.documents.index', $client) }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>

    </form>
</div>
@endsection