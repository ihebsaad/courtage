@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mandat_immo_3']) }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header">Date du RDV</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Date du RDV</label>
                        <input type="date" name="date_rdv" class="form-control" value="{{ $data['date_rdv'] ?? now()->format(format: 'Y-m-d') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Votre projet</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nature du projet</label>
                        <input type="text" name="nature_projet" class="form-control" value="{{ $data['nature_projet'] ?? 'Achat habitation principale' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Destination du logement</label>
                        <input type="text" name="destination_logement" class="form-control" value="{{ $data['destination_logement'] ?? 'Habitation RP' }}">
                    </div>
                </div>

                <h6 class="mt-3">Coût du projet estimatif - Dépenses</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Prix d'acquisition / CRD</label>
                        <input type="number" step="0.01" name="prix_acquisition" class="form-control" value="{{ $data['prix_acquisition'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Frais de notaire</label>
                        <input type="number" step="0.01" name="frais_notaire" class="form-control" value="{{ $data['frais_notaire'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Frais d'agence</label>
                        <input type="number" step="0.01" name="frais_agence" class="form-control" value="{{ $data['frais_agence'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Travaux</label>
                        <input type="number" step="0.01" name="travaux" class="form-control" value="{{ $data['travaux'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>IRA</label>
                        <input type="number" step="0.01" name="ira" class="form-control" value="{{ $data['ira'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Estimation frais de garantie</label>
                        <input type="number" step="0.01" name="frais_garantie" class="form-control" value="{{ $data['frais_garantie'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Estimation frais de banque</label>
                        <input type="number" step="0.01" name="frais_banque" class="form-control" value="{{ $data['frais_banque'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Honoraires de courtage</label>
                        <input type="number" step="0.01" name="honoraires_courtage" class="form-control" value="{{ $data['honoraires_courtage'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Ressources</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Apport personnel</label>
                        <input type="number" step="0.01" name="apport_personnel" class="form-control" value="{{ $data['apport_personnel'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Dont épargne</label>
                        <input type="number" step="0.01" name="dont_epargne" class="form-control" value="{{ $data['dont_epargne'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Dont donation</label>
                        <input type="number" step="0.01" name="dont_donation" class="form-control" value="{{ $data['dont_donation'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Échéance</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Date estimée signature</label>
                        <input type="date" name="date_signature" class="form-control" value="{{ $data['date_signature'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Priorité</label>
                        <input type="text" name="priorite" class="form-control" value="{{ $data['priorite'] ?? '1' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Vos objectifs</div>
            <div class="card-body">
                @foreach([
                    'constituer_patrimoine' => 'Se constituer un patrimoine',
                    'revenus_complementaires' => 'Obtenir des revenus complémentaires',
                    'proteger_proches' => 'Protéger ses proches',
                    'aider_enfants' => 'Aider ses enfants',
                    'optimiser_fiscalite' => 'Optimiser sa fiscalité',
                    'preparer_retraite' => 'Préparer sa retraite',
                    'financer_achat' => 'Financer un achat immobilier',
                    'preparer_transmission' => 'Préparer la transmission de son patrimoine',
                    'optimiser_rentabilite' => 'Optimiser la rentabilité de ses placements',
                    'proteger_conjoint' => 'Protéger le conjoint survivant',
                    'transmission_entreprise' => 'Préparer la transmission de son entreprise'
                ] as $key => $label)
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" name="objectif_{{ $key }}" class="form-check-input" value="1" {{ !empty($data["objectif_$key"]) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $label }}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="objectif_{{ $key }}_commentaire" class="form-control form-control-sm" placeholder="Commentaires" value="{{ $data["objectif_{$key}_commentaire"] ?? '' }}">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Vos informations personnelles - Client 1</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Prénom / Nom</label>
                        <input type="text" name="client1_nom" class="form-control" value="{{ $client->nom_complet }}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nom patronymique</label>
                        <input type="text" name="client1_nom_patronymique" class="form-control" value="{{ $client->nom }}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Situation familiale</label>
                        <input type="text" name="client1_situation" class="form-control" value="{{ $data['client1_situation'] ?? $client->situation_familiale }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Régime matrimonial</label>
                        <input type="text" name="client1_regime" class="form-control" value="{{ $data['client1_regime'] ?? $client->regime_matrimonial }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Date de naissance</label>
                        <input type="date" name="client1_date_naissance" class="form-control" value="{{ $client->date_naissance?->format('Y-m-d') }}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Lieu de naissance</label>
                        <input type="text" name="client1_lieu_naissance" class="form-control" value="{{ $data['client1_lieu_naissance'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nationalité</label>
                        <input type="text" name="client1_nationalite" class="form-control" value="{{ $client->nationalite ?? 'France' }}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nb d'enfants à charge</label>
                        <input type="number" name="client1_nb_enfants" class="form-control" value="{{ $client->nombre_enfants }}" readonly>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Adresse</label>
                        <input type="text" name="client1_adresse" class="form-control" value="{{ $client->adresse_complete }}" readonly>
                    </div>
                </div>

                <h6 class="mt-3">Logement actuel</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Statut</label>
                        <select name="client1_logement_statut" class="form-control">
                            <option value="Locataire" {{ ($data['client1_logement_statut'] ?? '') === 'Locataire' ? 'selected' : '' }}>Locataire</option>
                            <option value="Propriétaire" {{ ($data['client1_logement_statut'] ?? '') === 'Propriétaire' ? 'selected' : '' }}>Propriétaire</option>
                            <option value="Hébergé" {{ ($data['client1_logement_statut'] ?? '') === 'Hébergé' ? 'selected' : '' }}>Hébergé</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Type de logement</label>
                        <input type="text" name="client1_type_logement" class="form-control" value="{{ $data['client1_type_logement'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Montant du loyer</label>
                        <input type="number" step="0.01" name="client1_loyer" class="form-control" value="{{ $data['client1_loyer'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Depuis quand ?</label>
                        <input type="date" name="client1_depuis" class="form-control" value="{{ $data['client1_depuis'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Enfants</h6>
                @for($i = 1; $i <= 3; $i++)
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input type="text" name="client1_enfant{{ $i }}_nom" class="form-control form-control-sm" placeholder="Prénom / Nom enfant {{ $i }}" value="{{ $data["client1_enfant{$i}_nom"] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="client1_enfant{{ $i }}_date" class="form-control form-control-sm" value="{{ $data["client1_enfant{$i}_date"] ?? '' }}">
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Vos informations personnelles - Client 2 (Conjoint)</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Prénom / Nom</label>
                        <input type="text" name="client2_nom" class="form-control" value="{{ $data['client2_nom'] ?? ($client->conjoint_prenom . ' ' . $client->conjoint_nom) }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nom patronymique</label>
                        <input type="text" name="client2_nom_patronymique" class="form-control" value="{{ $data['client2_nom_patronymique'] ?? $client->conjoint_nom2 }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Situation familiale</label>
                        <input type="text" name="client2_situation" class="form-control" value="{{ $data['client2_situation'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Régime matrimonial</label>
                        <input type="text" name="client2_regime" class="form-control" value="{{ $data['client2_regime'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Date de naissance</label>
                        <input type="date" name="client2_date_naissance" class="form-control" value="{{ $data['client2_date_naissance'] ?? $client->conjoint_date_naissance }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Lieu de naissance</label>
                        <input type="text" name="client2_lieu_naissance" class="form-control" value="{{ $data['client2_lieu_naissance'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nationalité</label>
                        <input type="text" name="client2_nationalite" class="form-control" value="{{ $data['client2_nationalite'] ?? $client->conjoint_nationalite }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nb d'enfants à charge</label>
                        <input type="number" name="client2_nb_enfants" class="form-control" value="{{ $data['client2_nb_enfants'] ?? '' }}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Adresse</label>
                        <input type="text" name="client2_adresse" class="form-control" value="{{ $data['client2_adresse'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Mariage / PACS / Divorce</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Date du mariage / PACS</label>
                        <input type="date" name="date_mariage" class="form-control" value="{{ $data['date_mariage'] ?? $client->conjoint_date_mariage }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Date du divorce</label>
                        <input type="date" name="date_divorce" class="form-control" value="{{ $data['date_divorce'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Pension alimentaire</label>
                        <select name="pension_type" class="form-control">
                            <option value="">-</option>
                            <option value="Versée" {{ ($data['pension_type'] ?? '') === 'Versée' ? 'selected' : '' }}>Versée</option>
                            <option value="Reçue" {{ ($data['pension_type'] ?? '') === 'Reçue' ? 'selected' : '' }}>Reçue</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Montant pension</label>
                        <input type="number" step="0.01" name="pension_montant" class="form-control" value="{{ $data['pension_montant'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Logement actuel</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Statut</label>
                        <select name="client2_logement_statut" class="form-control">
                            <option value="Locataire" {{ ($data['client2_logement_statut'] ?? '') === 'Locataire' ? 'selected' : '' }}>Locataire</option>
                            <option value="Propriétaire" {{ ($data['client2_logement_statut'] ?? '') === 'Propriétaire' ? 'selected' : '' }}>Propriétaire</option>
                            <option value="Hébergé" {{ ($data['client2_logement_statut'] ?? '') === 'Hébergé' ? 'selected' : '' }}>Hébergé</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Type de logement</label>
                        <input type="text" name="client2_type_logement" class="form-control" value="{{ $data['client2_type_logement'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Montant du loyer</label>
                        <input type="number" step="0.01" name="client2_loyer" class="form-control" value="{{ $data['client2_loyer'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Enfants</h6>
                @for($i = 1; $i <= 3; $i++)
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input type="text" name="client2_enfant{{ $i }}_nom" class="form-control form-control-sm" placeholder="Prénom / Nom enfant {{ $i }}" value="{{ $data["client2_enfant{$i}_nom"] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <input type="date" name="client2_enfant{{ $i }}_date" class="form-control form-control-sm" value="{{ $data["client2_enfant{$i}_date"] ?? '' }}">
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Commentaires informations personnelles</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Client 1</label>
                        <textarea name="commentaire_client1" class="form-control" rows="2">{{ $data['commentaire_client1'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Client 2</label>
                        <textarea name="commentaire_client2" class="form-control" rows="2">{{ $data['commentaire_client2'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Projet via une société</div>
            <div class="card-body">
                <textarea name="projet_societe" class="form-control" rows="2" placeholder="(nom, forme, adresse, date de création, IR/IS, associé(s), % de parts)">{{ $data['projet_societe'] ?? '' }}</textarea>
            </div>
        </div>

<div class="card mb-3">
            <div class="card-header bg-dark text-white">Que faîtes-vous ? - Client 1</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client1_salarie" class="form-check-input" value="1" {{ !empty($data['client1_salarie']) ? 'checked' : '' }}>
                            <label class="form-check-label">Salarié⸱e</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client1_non_salarie" class="form-check-input" value="1" {{ !empty($data['client1_non_salarie']) ? 'checked' : '' }}>
                            <label class="form-check-label">Non salarié⸱e</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client1_retraite" class="form-check-input" value="1" {{ !empty($data['client1_retraite']) ? 'checked' : '' }}>
                            <label class="form-check-label">Retraité⸱e</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client1_intermittent" class="form-check-input" value="1" {{ !empty($data['client1_intermittent']) ? 'checked' : '' }}>
                            <label class="form-check-label">Intermittent du spectacle</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client1_pole_emploi" class="form-check-input" value="1" {{ !empty($data['client1_pole_emploi']) ? 'checked' : '' }}>
                            <label class="form-check-label">Pôle Emploi</label>
                        </div>
                    </div>
                </div>

                <h6 class="mt-3">Si Salarié⸱e</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Nombre d'emploi(s)</label>
                        <input type="number" name="client1_nb_emplois" class="form-control" value="{{ $data['client1_nb_emplois'] ?? '1' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Type de contrat(s)</label>
                        <input type="text" name="client1_type_contrats" class="form-control" value="{{ $data['client1_type_contrats'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Date d'entrée</label>
                        <input type="date" name="client1_date_entree" class="form-control" value="{{ $data['client1_date_entree'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nom employeur</label>
                        <input type="text" name="client1_nom_employeur" class="form-control" value="{{ $data['client1_nom_employeur'] ?? $client->employeur }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Poste / Métier</label>
                        <input type="text" name="client1_poste" class="form-control" value="{{ $data['client1_poste'] ?? $client->profession }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Salaire net</label>
                        <input type="number" step="0.01" name="client1_salaire_net" class="form-control" value="{{ $data['client1_salaire_net'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Prime Variable Bonus</label>
                        <input type="number" step="0.01" name="client1_prime" class="form-control" value="{{ $data['client1_prime'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Revenus sur 3 ans (N-1, N-2, N-3)</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Salaire N-1</label>
                        <input type="number" step="0.01" name="client1_salaire_n1" class="form-control" value="{{ $data['client1_salaire_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Salaire N-2</label>
                        <input type="number" step="0.01" name="client1_salaire_n2" class="form-control" value="{{ $data['client1_salaire_n2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Salaire N-3</label>
                        <input type="number" step="0.01" name="client1_salaire_n3" class="form-control" value="{{ $data['client1_salaire_n3'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Si Non salarié⸱e</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Activité</label>
                        <input type="text" name="client1_activite" class="form-control" value="{{ $data['client1_activite'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Statut</label>
                        <input type="text" name="client1_statut" class="form-control" value="{{ $data['client1_statut'] ?? '' }}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Quels sont vos clients ? Répartition CA ?</label>
                        <textarea name="client1_clients_ca" class="form-control" rows="2">{{ $data['client1_clients_ca'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>CA N-1</label>
                        <input type="number" step="0.01" name="client1_ca_n1" class="form-control" value="{{ $data['client1_ca_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>CA N-2</label>
                        <input type="number" step="0.01" name="client1_ca_n2" class="form-control" value="{{ $data['client1_ca_n2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>CA N-3</label>
                        <input type="number" step="0.01" name="client1_ca_n3" class="form-control" value="{{ $data['client1_ca_n3'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>RN / BNC N-1</label>
                        <input type="number" step="0.01" name="client1_rn_n1" class="form-control" value="{{ $data['client1_rn_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>RN / BNC N-2</label>
                        <input type="number" step="0.01" name="client1_rn_n2" class="form-control" value="{{ $data['client1_rn_n2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>RN / BNC N-3</label>
                        <input type="number" step="0.01" name="client1_rn_n3" class="form-control" value="{{ $data['client1_rn_n3'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Si Retraité⸱e</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>En retraite depuis</label>
                        <input type="date" name="client1_retraite_depuis" class="form-control" value="{{ $data['client1_retraite_depuis'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Montant pension /mois</label>
                        <input type="number" step="0.01" name="client1_pension_montant" class="form-control" value="{{ $data['client1_pension_montant'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Date prévue retraite (si pas encore)</label>
                        <input type="date" name="client1_date_prevue_retraite" class="form-control" value="{{ $data['client1_date_prevue_retraite'] ?? '' }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                        <label>Commentaires activité professionnelle</label>
                        <textarea name="client1_commentaire_activite" class="form-control" rows="2">{{ $data['client1_commentaire_activite'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Que faîtes-vous ? - Client 2</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client2_salarie" class="form-check-input" value="1" {{ !empty($data['client2_salarie']) ? 'checked' : '' }}>
                            <label class="form-check-label">Salarié⸱e</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client2_non_salarie" class="form-check-input" value="1" {{ !empty($data['client2_non_salarie']) ? 'checked' : '' }}>
                            <label class="form-check-label">Non salarié⸱e</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client2_retraite" class="form-check-input" value="1" {{ !empty($data['client2_retraite']) ? 'checked' : '' }}>
                            <label class="form-check-label">Retraité⸱e</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client2_intermittent" class="form-check-input" value="1" {{ !empty($data['client2_intermittent']) ? 'checked' : '' }}>
                            <label class="form-check-label">Intermittent du spectacle</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="client2_pole_emploi" class="form-check-input" value="1" {{ !empty($data['client2_pole_emploi']) ? 'checked' : '' }}>
                            <label class="form-check-label">Pôle Emploi</label>
                        </div>
                    </div>
                </div>

                <h6 class="mt-3">Si Salarié⸱e</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Nombre d'emploi(s)</label>
                        <input type="number" name="client2_nb_emplois" class="form-control" value="{{ $data['client2_nb_emplois'] ?? '1' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Type de contrat(s)</label>
                        <input type="text" name="client2_type_contrats" class="form-control" value="{{ $data['client2_type_contrats'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Date d'entrée</label>
                        <input type="date" name="client2_date_entree" class="form-control" value="{{ $data['client2_date_entree'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nom employeur</label>
                        <input type="text" name="client2_nom_employeur" class="form-control" value="{{ $data['client2_nom_employeur'] ?? $client->conjoint_employeur }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Poste / Métier</label>
                        <input type="text" name="client2_poste" class="form-control" value="{{ $data['client2_poste'] ?? $client->conjoint_profession }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Salaire net</label>
                        <input type="number" step="0.01" name="client2_salaire_net" class="form-control" value="{{ $data['client2_salaire_net'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Prime Variable Bonus</label>
                        <input type="number" step="0.01" name="client2_prime" class="form-control" value="{{ $data['client2_prime'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Revenus sur 3 ans (N-1, N-2, N-3)</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Salaire N-1</label>
                        <input type="number" step="0.01" name="client2_salaire_n1" class="form-control" value="{{ $data['client2_salaire_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Salaire N-2</label>
                        <input type="number" step="0.01" name="client2_salaire_n2" class="form-control" value="{{ $data['client2_salaire_n2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Salaire N-3</label>
                        <input type="number" step="0.01" name="client2_salaire_n3" class="form-control" value="{{ $data['client2_salaire_n3'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Si Non salarié⸱e</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Activité</label>
                        <input type="text" name="client2_activite" class="form-control" value="{{ $data['client2_activite'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Statut</label>
                        <input type="text" name="client2_statut" class="form-control" value="{{ $data['client2_statut'] ?? '' }}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Quels sont vos clients ? Répartition CA ?</label>
                        <textarea name="client2_clients_ca" class="form-control" rows="2">{{ $data['client2_clients_ca'] ?? '' }}</textarea>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>CA N-1</label>
                        <input type="number" step="0.01" name="client2_ca_n1" class="form-control" value="{{ $data['client2_ca_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>CA N-2</label>
                        <input type="number" step="0.01" name="client2_ca_n2" class="form-control" value="{{ $data['client2_ca_n2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>CA N-3</label>
                        <input type="number" step="0.01" name="client2_ca_n3" class="form-control" value="{{ $data['client2_ca_n3'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>RN / BNC N-1</label>
                        <input type="number" step="0.01" name="client2_rn_n1" class="form-control" value="{{ $data['client2_rn_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>RN / BNC N-2</label>
                        <input type="number" step="0.01" name="client2_rn_n2" class="form-control" value="{{ $data['client2_rn_n2'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>RN / BNC N-3</label>
                        <input type="number" step="0.01" name="client2_rn_n3" class="form-control" value="{{ $data['client2_rn_n3'] ?? '' }}">
                    </div>
                </div>

                <h6 class="mt-3">Si Retraité⸱e</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>En retraite depuis</label>
                        <input type="date" name="client2_retraite_depuis" class="form-control" value="{{ $data['client2_retraite_depuis'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Montant pension /mois</label>
                        <input type="number" step="0.01" name="client2_pension_montant" class="form-control" value="{{ $data['client2_pension_montant'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Date prévue retraite (si pas encore)</label>
                        <input type="date" name="client2_date_prevue_retraite" class="form-control" value="{{ $data['client2_date_prevue_retraite'] ?? '' }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 mb-2">
                        <label>Commentaires activité professionnelle</label>
                        <textarea name="client2_commentaire_activite" class="form-control" rows="2">{{ $data['client2_commentaire_activite'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">Votre imposition</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label>Nb de parts fiscales</label>
                        <input type="number" step="0.5" name="nb_parts_fiscales" class="form-control" value="{{ $data['nb_parts_fiscales'] ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Revenu déclaré N-1</label>
                        <input type="number" step="0.01" name="revenu_declare_n1" class="form-control" value="{{ $data['revenu_declare_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Montant impôts</label>
                        <input type="number" step="0.01" name="montant_impots" class="form-control" value="{{ $data['montant_impots'] ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>RFR N-1</label>
                        <input type="number" step="0.01" name="rfr_n1" class="form-control" value="{{ $data['rfr_n1'] ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>RFR N-2</label>
                        <input type="number" step="0.01" name="rfr_n2" class="form-control" value="{{ $data['rfr_n2'] ?? '' }}">
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

<style>
.bg-dark { background-color: #343a40 !important; }
</style>
@endsection