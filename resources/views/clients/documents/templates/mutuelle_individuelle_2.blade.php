@extends('layouts.admin')

@section('title', $client->nom_complet.' Gestion des Documents')
@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    @if($hasSavedData ?? false)
        <div class="alert alert-info mb-3">
            <i class="fas fa-info-circle"></i> Des données ont été sauvegardées précédemment pour ce document.
        </div>
    @endif

    <form action="{{ route('clients.documents.generate', [$client, 'mutuelle_individuelle_2']) }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Informations du souscripteur</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Civilité</label>
                        <input type="text" name="civilite" class="form-control" value="{{ $data['civilite'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nom d'usage</label>
                        <input type="text" name="nom_usage" class="form-control" value="{{ $data['nom_usage'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nom de naissance</label>
                        <input type="text" name="nom_naissance" class="form-control" value="{{ $data['nom_naissance'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Prénoms</label>
                        <input type="text" name="prenoms" class="form-control" value="{{ $data['prenoms'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de naissance</label>
                        <input type="text" name="date_naissance" class="form-control" value="{{ $data['date_naissance'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Situation familiale</label>
                        <input type="text" name="situation_familiale" class="form-control" value="{{ $data['situation_familiale'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control" value="{{ $data['adresse'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $data['email'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Téléphone mobile</label>
                        <input type="text" name="telephone_mobile" class="form-control" value="{{ $data['telephone_mobile'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Profession</label>
                        <input type="text" name="profession" class="form-control" value="{{ $data['profession'] ?? '' }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Informations complémentaires (à remplir)</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Personne Politiquement Exposée (PPE)</label>
                        <select name="ppe" class="form-control" required>
                            <option value="">Sélectionner</option>
                            <option value="Oui" {{ ($data['ppe'] ?? '') === 'Oui' ? 'selected' : '' }}>Oui</option>
                            <option value="Non" {{ ($data['ppe'] ?? '') === 'Non' ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Fonction exercée (si PPE)</label>
                        <input type="text" name="fonction_exercee" class="form-control" value="{{ $data['fonction_exercee'] ?? '' }}"> 
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date de cessation (si PPE)</label>
                        <input type="date" name="date_cessation" class="form-control" value="{{ $data['date_cessation'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Lien avec la PPE</label>
                        <input type="text" name="lien_ppe" class="form-control" value="{{ $data['lien_ppe'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Régime social</label>
                        <select name="regime_social" class="form-control" required>
                            <option value="">Sélectionner</option>
                            <option value="SSI" {{ ($data['regime_social'] ?? '') === 'SSI' ? 'selected' : '' }}>Sécurité sociale pour les indépendants (SSI)</option>
                            <option value="CPAM" {{ ($data['regime_social'] ?? '') === 'CPAM' ? 'selected' : '' }}>Caisse Primaire d'Assurance Maladie (CPAM)</option>
                            <option value="Alsace Moselle" {{ ($data['regime_social'] ?? '') === 'Alsace Moselle' ? 'selected' : '' }}>Régime local Alsace Moselle</option>
                            <option value="CARMF" {{ ($data['regime_social'] ?? '') === 'CARMF' ? 'selected' : '' }}>Caisse Autonome de Retraite des Médecins de France (CARMF)</option>
                            <option value="Autre" {{ ($data['regime_social'] ?? '') === 'Autre' ? 'selected' : '' }}>Autre</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Avantages Madelin</label>
                        <select name="madelin" class="form-control" required>
                            <option value="">Sélectionner</option>
                            <option value="Oui" {{ ($data['madelin'] ?? '') === 'Oui' ? 'selected' : '' }}>Oui</option>
                            <option value="Non" {{ ($data['madelin'] ?? '') === 'Non' ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Besoins en assurance</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold">Besoins (1 = faible, 5 = élevé)</label>
                    <table class="table table-bordered table-sm mt-2">
                        <thead class="table-light">
                            <tr>
                                <th>Poste</th>
                                @for($i = 1; $i <= 5; $i++)<th class="text-center">{{ $i }}</th>@endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([
                                'note_hospitalisation' => 'Hospitalisation',
                                'note_consultation'    => 'Consultation',
                                'note_optique'         => 'Optique',
                                'note_dentaire'        => 'Dentaire',
                                'note_prevention'      => 'Prévention (médecines douces)',
                            ] as $field => $label)
                            <tr>
                                <td>{{ $label }}</td>
                                @for($i = 1; $i <= 5; $i++)
                                <td class="text-center">
                                    <input type="radio" name="{{ $field }}" value="{{ $i }}"
                                        {{ ($data[$field] ?? '') == $i ? 'checked' : '' }}>
                                </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>                
                <div class="mb-3">
                    <label>En cas de décès</label>
                    <textarea name="besoins_deces" class="form-control" rows="2" required>{{ $data['besoins_deces'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label>En cas d'incapacité de travail</label>
                    <textarea name="besoins_incapacite" class="form-control" rows="2" required>{{ $data['besoins_incapacite'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label>En cas de dépendance</label>
                    <textarea name="besoins_dependance" class="form-control" rows="2">{{ $data['besoins_dependance'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Besoins spécifiques</label>
                    <select name="besoins_specifiques" class="form-control" required>
                        <option value="">Sélectionner</option>
                        <option value="Oui" {{ ($data['besoins_specifiques'] ?? '') === 'Oui' ? 'selected' : '' }}>Oui</option>
                        <option value="Non" {{ ($data['besoins_specifiques'] ?? '') === 'Non' ? 'selected' : '' }}>Non</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Description du besoin</label>
                    <textarea name="description_besoin" class="form-control" rows="3" required>{{ $data['description_besoin'] ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label>Type de souscription</label>
                    <select name="type_souscription" class="form-control" required>
                        <option value="">Sélectionner</option>
                        <option value="première souscription" {{ ($data['type_souscription'] ?? '') === 'première souscription' ? 'selected' : '' }}>Première souscription</option>
                        <option value="remplacement d'un contrat existant" {{ ($data['type_souscription'] ?? '') === 'remplacement d\'un contrat existant' ? 'selected' : '' }}>Remplacement d'un contrat existant</option>
                        <option value="renouvellement" {{ ($data['type_souscription'] ?? '') === 'renouvellement' ? 'selected' : '' }}>Renouvellement</option>
                    </select>
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