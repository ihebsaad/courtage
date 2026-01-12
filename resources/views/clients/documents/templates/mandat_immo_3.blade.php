@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mandat_immo_3']) }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Informations du client</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Civilité</label>
                        <input type="text" class="form-control" value="{{ $client->civilite ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nom</label>
                        <input type="text" class="form-control" value="{{ $client->nom ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Prénom</label>
                        <input type="text" class="form-control" value="{{ $client->prenom ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance</label>
                        <input type="text" class="form-control" value="{{ $client->date_naissance?->format('d/m/Y') ?? '' }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Adresse complète</label>
                        <input type="text" class="form-control" value="{{ $client->adresse_complete ?? '' }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Informations du conjoint (si applicable)</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Civilité du conjoint</label>
                        <input type="text" name="conjoint_civilite" class="form-control" value="{{   $client->conjoint_civilite ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nom du conjoint</label>
                        <input type="text" name="conjoint_nom" class="form-control" value="{{   $client->conjoint_nom ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Prénom du conjoint</label>
                        <input type="text" name="conjoint_prenom" class="form-control" value="{{  $client->conjoint_prenom ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance du conjoint</label>
                        <input type="date" name="conjoint_date_naissance" class="form-control" value="{{   ($client->conjoint_date_naissance ? \Carbon\Carbon::parse($client->conjoint_date_naissance)->format('Y-m-d') : '') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Détails du projet</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nature du bien recherché</label>
                        <select name="nature_bien" class="form-control" required>
                            <option value="">Sélectionner...</option>
                            <option value="Appartement" {{ ($data['nature_bien'] ?? '') === 'Appartement' ? 'selected' : '' }}>Appartement</option>
                            <option value="Maison" {{ ($data['nature_bien'] ?? '') === 'Maison' ? 'selected' : '' }}>Maison</option>
                            <option value="Terrain" {{ ($data['nature_bien'] ?? '') === 'Terrain' ? 'selected' : '' }}>Terrain</option>
                            <option value="Immeuble" {{ ($data['nature_bien'] ?? '') === 'Immeuble' ? 'selected' : '' }}>Immeuble</option>
                            <option value="Parking" {{ ($data['nature_bien'] ?? '') === 'Parking' ? 'selected' : '' }}>Parking</option>
                            <option value="Commerce" {{ ($data['nature_bien'] ?? '') === 'Commerce' ? 'selected' : '' }}>Commerce</option>
                            <option value="Autre" {{ ($data['nature_bien'] ?? '') === 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Localisation recherchée</label>
                        <input type="text" name="localisation" class="form-control" value="{{ $data['localisation'] ?? '' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Surface souhaitée (m²)</label>
                        <input type="text" name="surface_souhaitee" class="form-control" value="{{ $data['surface_souhaitee'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nombre de pièces</label>
                        <input type="text" name="nombre_pieces" class="form-control" value="{{ $data['nombre_pieces'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Budget minimum (€)</label>
                        <input type="number" name="budget_min" class="form-control" value="{{ $data['budget_min'] ?? '' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Budget maximum (€)</label>
                        <input type="number" name="budget_max" class="form-control" value="{{ $data['budget_max'] ?? '' }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Critères spécifiques</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Critères supplémentaires</label>
                    <textarea name="criteres_supplementaires" class="form-control" rows="4">{{ $data['criteres_supplementaires'] ?? '' }}</textarea>
                    <small class="form-text text-muted">Ex: Proximité transports, jardin, balcon, parking, étage, ascenseur, etc.</small>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Financement</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Apport personnel (€)</label>
                        <input type="number" name="apport_personnel" class="form-control" value="{{ $data['apport_personnel'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Accord de principe bancaire</label>
                        <select name="accord_bancaire" class="form-control">
                            <option value="non" {{ ($data['accord_bancaire'] ?? 'non') === 'non' ? 'selected' : '' }}>Non</option>
                            <option value="oui" {{ ($data['accord_bancaire'] ?? '') === 'oui' ? 'selected' : '' }}>Oui</option>
                            <option value="en_cours" {{ ($data['accord_bancaire'] ?? '') === 'en_cours' ? 'selected' : '' }}>En cours</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Capacité d'emprunt mensuelle (€)</label>
                        <input type="number" name="capacite_emprunt" class="form-control" value="{{ $data['capacite_emprunt'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Délai et disponibilité</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Délai souhaité pour l'acquisition</label>
                        <select name="delai_acquisition" class="form-control">
                            <option value="immediat" {{ ($data['delai_acquisition'] ?? '') === 'immediat' ? 'selected' : '' }}>Immédiat (moins de 3 mois)</option>
                            <option value="court_terme" {{ ($data['delai_acquisition'] ?? '') === 'court_terme' ? 'selected' : '' }}>Court terme (3-6 mois)</option>
                            <option value="moyen_terme" {{ ($data['delai_acquisition'] ?? 'moyen_terme') === 'moyen_terme' ? 'selected' : '' }}>Moyen terme (6-12 mois)</option>
                            <option value="long_terme" {{ ($data['delai_acquisition'] ?? '') === 'long_terme' ? 'selected' : '' }}>Long terme (plus de 12 mois)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Disponibilité pour les visites</label>
                        <input type="text" name="disponibilite_visites" class="form-control" value="{{ $data['disponibilite_visites'] ?? '' }}" placeholder="Ex: Weekends, Soirs en semaine">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Mandat et honoraires</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Date de début du mandat</label>
                        <input type="date" name="date_debut_mandat" class="form-control" value="{{ $data['date_debut_mandat'] ?? now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de fin du mandat</label>
                        <input type="date" name="date_fin_mandat" class="form-control" value="{{ $data['date_fin_mandat'] ?? now()->addMonths(6)->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Montant des honoraires (€ HT)</label>
                        <input type="number" name="montant_honoraires" class="form-control" value="{{ $data['montant_honoraires'] ?? '' }}" step="0.01">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Type de mandat</label>
                        <select name="type_mandat" class="form-control">
                            <option value="simple" {{ ($data['type_mandat'] ?? 'simple') === 'simple' ? 'selected' : '' }}>Mandat simple</option>
                            <option value="exclusif" {{ ($data['type_mandat'] ?? '') === 'exclusif' ? 'selected' : '' }}>Mandat exclusif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Informations complémentaires</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Commentaires / Informations supplémentaires</label>
                    <textarea name="commentaires" class="form-control" rows="4">{{ $data['commentaires'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Signature</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nom du conseiller</label>
                        <input type="text" name="nom_conseiller" class="form-control" value="{{ $data['nom_conseiller'] ?? 'Raphaël JACOB' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Fait à</label>
                        <input type="text" name="fait_a" class="form-control" value="{{ $data['fait_a'] ?? 'Paris' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date du document</label>
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