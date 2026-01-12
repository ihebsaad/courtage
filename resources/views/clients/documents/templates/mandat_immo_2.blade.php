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
                        <input type="text" name="civilite_client1" class="form-control" value="{{ ($client->civilite === 'M' ? 'Monsieur' : 'Madame') }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nom Client 1</label>
                        <input type="text" name="nom_client1" class="form-control" value="{{   $client->nom }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Prénom Client 1</label>
                        <input type="text" name="prenom_client1" class="form-control" value="{{   $client->prenom }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Adresse Client 1</label>
                        <input type="text" name="adresse_client1" class="form-control" value="{{   $client->adresse_complete }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance Client 1</label>
                        <input type="text" name="date_naissance_client1" class="form-control" value="{{   ($client->date_naissance ? $client->date_naissance->format('d/m/Y') : '') }}" readonly>
                    </div>
                </div>

                @if($client->conjoint_nom)
                <hr>
                <h6>Conjoint</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Civilité Conjoint</label>
                        <input type="text" name="civilite_client2" class="form-control" value="{{   ($client->conjoint_civilite === 'M' ? 'Monsieur' : 'Madame') }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nom Conjoint</label>
                        <input type="text" name="nom_client2" class="form-control" value="{{  $client->conjoint_nom }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Prénom Conjoint</label>
                        <input type="text" name="prenom_client2" class="form-control" value="{{  $client->conjoint_prenom }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Adresse Conjoint</label>
                        <input type="text" name="adresse_client2" class="form-control" value="{{   $client->adresse_complete }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance Conjoint</label>
                        <input type="text" name="date_naissance_client2" class="form-control" value="{{  ($client->conjoint_date_naissance  }}" readonly>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Projet de financement</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Montant du crédit immobilier (€)</label>
                        <input type="number" name="montant_credit" class="form-control" value="{{ $data['montant_credit'] ?? '' }}" step="0.01" placeholder="Ex: 250000">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Apport personnel (€)</label>
                        <input type="number" name="apport_personnel" class="form-control" value="{{ $data['apport_personnel'] ?? '' }}" step="0.01" placeholder="Ex: 50000">
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
                        <label>Date de fin du mandat (3 mois)</label>
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
                        <input type="number" name="montant_honoraires" class="form-control" value="{{ $data['montant_honoraires'] ?? '' }}" step="0.01" placeholder="Ex: 2000">
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