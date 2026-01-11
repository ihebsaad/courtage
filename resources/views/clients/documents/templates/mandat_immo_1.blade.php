@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mandat_immo_1']) }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Informations du client</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Civilité</label>
                        <select name="civilite" class="form-control" required>
                            <option value="MR" {{ ($data['civilite'] ?? '') === 'MR' ? 'selected' : '' }}>MR</option>
                            <option value="MME" {{ ($data['civilite'] ?? '') === 'MME' ? 'selected' : '' }}>MME</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Type de client</label>
                        <select name="type_client" class="form-control" required>
                            <option value="PARTICULIER" {{ ($data['type_client'] ?? 'PARTICULIER') === 'PARTICULIER' ? 'selected' : '' }}>PARTICULIER</option>
                            <option value="ENTREPRISE" {{ ($data['type_client'] ?? '') === 'ENTREPRISE' ? 'selected' : '' }}>ENTREPRISE</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Nom du client</label>
                        <input type="text" name="nom_client" class="form-control" value="{{  $client->nom_complet }}" required>
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
                        <input type="text" name="nom_conseiller" class="form-control" value="{{ $data['nom_conseiller'] ?? 'Raphaël JACOB' }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Date et lieu</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Fait à</label>
                        <input type="text" name="fait_a" class="form-control" value="{{ $data['fait_a'] ?? 'Paris' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date</label>
                        <input type="date" name="date_document" class="form-control" value="{{ $data['date_document'] ?? now()->format('Y-m-d') }}" required>
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