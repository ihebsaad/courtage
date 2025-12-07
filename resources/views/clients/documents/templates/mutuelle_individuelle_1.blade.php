@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mutuelle_individuelle_1']) }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Informations du client</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Nom complet</label>
                        <input type="text" name="nom_complet" class="form-control" value="{{ $client->nom_complet }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date d'entrée en relation</label>
                        <input type="date" name="date_entree_relation" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Type de rémunération</div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_remuneration" id="commission" value="commission" checked>
                        <label class="form-check-label" for="commission">
                            Commission (rémunération incluse dans la prime d'assurance)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_remuneration" id="honoraires" value="honoraires">
                        <label class="form-check-label" for="honoraires">
                            Honoraires
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success btn-lg">
                Télécharger en PDF
            </button>
            <a href="{{ route('clients.documents.index', $client) }}" class="btn btn-secondary btn-lg">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection