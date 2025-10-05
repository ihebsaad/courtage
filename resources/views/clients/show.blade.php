@extends('layouts.admin')

@section('title', 'Détails du client')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-user mr-2"></i>
                        @if($client->type === 'particulier')
                            {{ $client->civilite }} {{ $client->prenom }} {{ $client->nom }}
                        @else
                            {{ $client->raison_sociale }}
                        @endif
                    </h2>
                    <p class="text-muted mb-0">
                        <span class="badge badge-{{ $client->statut === 'client' ? 'success' : 'warning' }} mr-2">
                            {{ ucfirst($client->statut) }}
                        </span>
                        <span class="badge badge-{{ $client->type === 'particulier' ? 'primary' : 'info' }}">
                            {{ $client->type === 'particulier' ? 'Particulier' : 'Entreprise' }}
                        </span>
                    </p>
                </div>
                <div>
                    <a class="btn btn-secondary mr-2" href="{{ route('clients.index') }}">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                    @if($client->statut === 'prospect')
                        <form method="POST" action="{{ route('clients.convert', $client) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success mr-2" onclick="return confirm('Convertir ce prospect en client ?')">
                                <i class="fas fa-handshake mr-2"></i>Convertir en client
                            </button>
                        </form>
                    @endif
                    <a class="btn btn-warning mr-2" href="{{ route('clients.edit', $client) }}">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                    <form method="POST" action="{{ route('clients.destroy', $client) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                            <i class="fas fa-trash mr-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Informations générales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>Informations générales
                    </h6>
                </div>
                <div class="card-body">
                    @if($client->type === 'particulier')
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold text-primary">Identité</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Civilité :</td>
                                        <td>{{ $client->civilite }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Nom :</td>
                                        <td>{{ $client->nom }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Prénom :</td>
                                        <td>{{ $client->prenom }}</td>
                                    </tr>
                                    @if($client->date_naissance)
                                    <tr>
                                        <td class="font-weight-bold">Date de naissance :</td>
                                        <td>{{ $client->date_naissance->format('d/m/Y') }}</td>
                                    </tr>
                                    @endif
                                    @if($client->nationalite)
                                    <tr>
                                        <td class="font-weight-bold">Nationalité :</td>
                                        <td>{{ $client->nationalite }}</td>
                                    </tr>
                                    @endif
                                    @if($client->situation_familiale)
                                    <tr>
                                        <td class="font-weight-bold">Situation familiale :</td>
                                        <td>{{ ucfirst($client->situation_familiale) }}</td>
                                    </tr>
                                    @endif
                                    @if($client->regime_matrimonial)
                                    <tr>
                                        <td class="font-weight-bold">Régime matrimonial :</td>
                                        <td>{{ str_replace('_', ' ', ucfirst($client->regime_matrimonial)) }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if($client->profession || $client->employeur || $client->type_contrat)
                                <h6 class="font-weight-bold text-success">Situation professionnelle</h6>
                                <table class="table table-sm table-borderless">
                                    @if($client->profession)
                                    <tr>
                                        <td class="font-weight-bold">Profession :</td>
                                        <td>{{ $client->profession }}</td>
                                    </tr>
                                    @endif
                                    @if($client->employeur)
                                    <tr>
                                        <td class="font-weight-bold">Employeur :</td>
                                        <td>{{ $client->employeur }}</td>
                                    </tr>
                                    @endif
                                    @if($client->type_contrat)
                                    <tr>
                                        <td class="font-weight-bold">Type de contrat :</td>
                                        <td>{{ strtoupper($client->type_contrat) }}</td>
                                    </tr>
                                    @endif
                                </table>
                                @endif
                            </div>
                        </div>

                        <!-- Enfants -->
                        @if(isset($client->enfants) && is_array($client->enfants) && count($client->enfants) > 0)
                        <hr class="my-3">
                        <h6 class="font-weight-bold text-secondary mb-3">
                            <i class="fas fa-child mr-2"></i>Enfants ({{ count($client->enfants) }})
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Civilité</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Date de naissance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client->enfants as $enfant)
                                    <tr>
                                        <td>{{ $enfant['civilite'] ?? '-' }}</td>
                                        <td>{{ $enfant['nom'] ?? '-' }}</td>
                                        <td>{{ $enfant['prenom'] ?? '-' }}</td>
                                        <td>{{ isset($enfant['date_naissance']) ? \Carbon\Carbon::parse($enfant['date_naissance'])->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="font-weight-bold text-info">Informations entreprise</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Raison sociale :</td>
                                        <td>{{ $client->raison_sociale }}</td>
                                    </tr>
                                    @if($client->statut_juridique)
                                    <tr>
                                        <td class="font-weight-bold">Statut juridique :</td>
                                        <td>{{ $client->statut_juridique }}</td>
                                    </tr>
                                    @endif
                                    @if($client->secteur_activite)
                                    <tr>
                                        <td class="font-weight-bold">Secteur d'activité :</td>
                                        <td>{{ $client->secteur_activite }}</td>
                                    </tr>
                                    @endif
                                    @if($client->siret)
                                    <tr>
                                        <td class="font-weight-bold">SIRET :</td>
                                        <td>{{ $client->siret }}</td>
                                    </tr>
                                    @endif
                                    @if($client->nombre_associes)
                                    <tr>
                                        <td class="font-weight-bold">Nombre d'associés :</td>
                                        <td>{{ $client->nombre_associes }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if($client->ca_entreprise || $client->rn_entreprise || $client->valorisation_entreprise)
                                <h6 class="font-weight-bold text-warning">Éléments financiers</h6>
                                <table class="table table-sm table-borderless">
                                    @if($client->ca_entreprise)
                                    <tr>
                                        <td class="font-weight-bold">Chiffre d'affaires :</td>
                                        <td>{{ number_format($client->ca_entreprise, 2, ',', ' ') }} €</td>
                                    </tr>
                                    @endif
                                    @if($client->rn_entreprise)
                                    <tr>
                                        <td class="font-weight-bold">Résultat net :</td>
                                        <td>{{ number_format($client->rn_entreprise, 2, ',', ' ') }} €</td>
                                    </tr>
                                    @endif
                                    @if($client->valorisation_entreprise)
                                    <tr>
                                        <td class="font-weight-bold">Valorisation :</td>
                                        <td>{{ number_format($client->valorisation_entreprise, 2, ',', ' ') }} €</td>
                                    </tr>
                                    @endif
                                </table>
                                @endif
                            </div>
                        </div>

                        <!-- Associés -->
                        @if(isset($client->associes) && is_array($client->associes) && count($client->associes) > 0)
                        <hr class="my-3">
                        <h6 class="font-weight-bold text-secondary mb-3">
                            <i class="fas fa-users mr-2"></i>Associés ({{ count($client->associes) }})
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Date de naissance</th>
                                        <th>Adresse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($client->associes as $associe)
                                    <tr>
                                        <td>{{ $associe['prenom'] ?? '-' }}</td>
                                        <td>{{ $associe['nom'] ?? '-' }}</td>
                                        <td>{{ isset($associe['date_naissance']) ? \Carbon\Carbon::parse($associe['date_naissance'])->format('d/m/Y') : '-' }}</td>
                                        <td>{{ $associe['adresse'] ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if($client->repartition_capital)
                        <hr class="my-3">
                        <h6 class="font-weight-bold text-secondary mb-2">
                            <i class="fas fa-chart-pie mr-2"></i>Répartition du capital social
                        </h6>
                        <p class="text-muted">{{ $client->repartition_capital }}</p>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Coordonnées -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-address-card mr-2"></i>Coordonnées
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-primary">Contact</h6>
                            <table class="table table-sm table-borderless">
                                @if($client->email)
                                <tr>
                                    <td class="font-weight-bold">Email :</td>
                                    <td>
                                        <a href="mailto:{{ $client->email }}">
                                            <i class="fas fa-envelope mr-1"></i>{{ $client->email }}
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @if($client->telephone)
                                <tr>
                                    <td class="font-weight-bold">Téléphone :</td>
                                    <td>
                                        <a href="tel:{{ $client->telephone }}">
                                            <i class="fas fa-phone mr-1"></i>{{ $client->telephone }}
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @if($client->telephone_portable)
                                <tr>
                                    <td class="font-weight-bold">Portable :</td>
                                    <td>
                                        <a href="tel:{{ $client->telephone_portable }}">
                                            <i class="fas fa-mobile-alt mr-1"></i>{{ $client->telephone_portable }}
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-success">Adresse</h6>
                            <table class="table table-sm table-borderless">
                                @if($client->adresse)
                                <tr>
                                    <td class="font-weight-bold">Adresse :</td>
                                    <td>{{ $client->adresse }}</td>
                                </tr>
                                @endif
                                @if($client->code_postal || $client->ville)
                                <tr>
                                    <td class="font-weight-bold">Ville :</td>
                                    <td>{{ $client->code_postal }} {{ $client->ville }}</td>
                                </tr>
                                @endif
                                @if($client->pays)
                                <tr>
                                    <td class="font-weight-bold">Pays :</td>
                                    <td>{{ $client->pays }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenus (Particuliers) -->
            @if($client->type === 'particulier' && isset($client->revenus_details) && is_array($client->revenus_details) && count($client->revenus_details) > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-euro-sign mr-2"></i>Revenus
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Type de revenu</th>
                                    <th class="text-right">Montant annuel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalRevenus = 0; @endphp
                                @foreach($client->revenus_details as $revenu)
                                <tr>
                                    <td>
                                        @switch($revenu['type'] ?? '')
                                            @case('salaire') Salaire @break
                                            @case('bic') BIC @break
                                            @case('bnc') BNC @break
                                            @case('remuneration_gerance') Rémunération de gérance @break
                                            @case('revenus_fonciers') Revenus fonciers @break
                                            @default {{ $revenu['type'] ?? '-' }}
                                        @endswitch
                                    </td>
                                    <td class="text-right">
                                        @if(isset($revenu['montant']))
                                            {{ number_format($revenu['montant'], 2, ',', ' ') }} €
                                            @php $totalRevenus += $revenu['montant']; @endphp
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="font-weight-bold bg-light">
                                    <td>Total</td>
                                    <td class="text-right">{{ number_format($totalRevenus, 2, ',', ' ') }} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Patrimoine (Particuliers) -->
            @if($client->type === 'particulier' && (
                (isset($client->patrimoine_immobilier) && is_array($client->patrimoine_immobilier) && count($client->patrimoine_immobilier) > 0) ||
                (isset($client->patrimoine_mobilier) && is_array($client->patrimoine_mobilier) && count($client->patrimoine_mobilier) > 0)
            ))
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-coins mr-2"></i>Patrimoine
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Immobilier -->
                    @if(isset($client->patrimoine_immobilier) && is_array($client->patrimoine_immobilier) && count($client->patrimoine_immobilier) > 0)
                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-home mr-2"></i>Patrimoine immobilier
                    </h6>
                    @foreach($client->patrimoine_immobilier as $index => $bien)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <h6 class="font-weight-bold">Bien #{{ $index + 1 }}</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="font-weight-bold">Type :</td>
                                        <td>{{ ucfirst($bien['type_bien'] ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Usage :</td>
                                        <td>{{ strtoupper($bien['usage'] ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Destination :</td>
                                        <td>{{ ucfirst($bien['destination'] ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Date d'achat :</td>
                                        <td>{{ isset($bien['date_achat']) ? \Carbon\Carbon::parse($bien['date_achat'])->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td class="font-weight-bold">Valeur d'achat :</td>
                                        <td>{{ isset($bien['valeur_achat']) ? number_format($bien['valeur_achat'], 2, ',', ' ') . ' €' : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Valeur actuelle :</td>
                                        <td>{{ isset($bien['valeur_actuelle']) ? number_format($bien['valeur_actuelle'], 2, ',', ' ') . ' €' : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Capital restant :</td>
                                        <td>{{ isset($bien['capital_restant']) ? number_format($bien['capital_restant'], 2, ',', ' ') . ' €' : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Annuité :</td>
                                        <td>{{ isset($bien['annuite']) ? number_format($bien['annuite'], 2, ',', ' ') . ' €' : '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <!-- Mobilier -->
                    @if(isset($client->patrimoine_mobilier) && is_array($client->patrimoine_mobilier) && count($client->patrimoine_mobilier) > 0)
                    <hr class="my-4">
                    <h6 class="font-weight-bold text-success mb-3">
                        <i class="fas fa-wallet mr-2"></i>Patrimoine mobilier
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Type de contrat</th>
                                    <th class="text-right">Montant</th>
                                    <th>Établissement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalMobilier = 0; @endphp
                                @foreach($client->patrimoine_mobilier as $contrat)
                                <tr>
                                    <td>{{ strtoupper($contrat['type_contrat'] ?? '-') }}</td>
                                    <td class="text-right">
                                        @if(isset($contrat['montant']))
                                            {{ number_format($contrat['montant'], 2, ',', ' ') }} €
                                            @php $totalMobilier += $contrat['montant']; @endphp
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $contrat['etablissement'] ?? '-' }}</td>
                                </tr>
                                @endforeach
                                <tr class="font-weight-bold bg-light">
                                    <td>Total</td>
                                    <td class="text-right">{{ number_format($totalMobilier, 2, ',', ' ') }} €</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Commentaires -->
            @if(isset($client->commentaires) && is_array($client->commentaires) && count($client->commentaires) > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-secondary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-comments mr-2"></i>Commentaires ({{ count($client->commentaires) }})
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($client->commentaires as $commentaire)
                    <div class="border-left-primary p-3 mb-3 bg-light">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ isset($commentaire['date']) ? \Carbon\Carbon::parse($commentaire['date'])->format('d/m/Y à H:i') : '-' }}
                                </small>
                            </div>
                        </div>
                        <p class="mb-0 mt-2">{{ $commentaire['texte'] ?? '' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Colonne latérale -->
        <div class="col-lg-4">
            <!-- Résumé -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-secondary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Résumé
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <div class="border-left-{{ $client->statut === 'client' ? 'success' : 'warning' }} p-3">
                                <div class="text-xs font-weight-bold text-{{ $client->statut === 'client' ? 'success' : 'warning' }} text-uppercase mb-1">
                                    Statut
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ ucfirst($client->statut) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="border-left-{{ $client->type === 'particulier' ? 'primary' : 'info' }} p-3">
                                <div class="text-xs font-weight-bold text-{{ $client->type === 'particulier' ? 'primary' : 'info' }} text-uppercase mb-1">
                                    Type
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $client->type === 'particulier' ? 'Particulier' : 'Entreprise' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="border-left-dark p-3">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Créé le
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $client->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-bolt mr-2"></i>Actions rapides
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($client->email)
                        <a href="mailto:{{ $client->email }}" class="btn btn-outline-primary btn-sm mb-2">
                            <i class="fas fa-envelope mr-2"></i>Envoyer un email
                        </a>
                        @endif
                        
                        @if($client->telephone)
                        <a href="tel:{{ $client->telephone }}" class="btn btn-outline-success btn-sm mb-2">
                            <i class="fas fa-phone mr-2"></i>Appeler
                        </a>
                        @endif
                        
                        <button type="button" class="btn btn-outline-info btn-sm mb-2" data-toggle="modal" data-target="#documentsModal">
                            <i class="fas fa-file-alt mr-2"></i>Gérer les documents
                        </button>
                        
                        <button type="button" class="btn btn-outline-warning btn-sm mb-2" onclick="updateStatus()">
                            <i class="fas fa-sync mr-2"></i>Changer le statut
                        </button>
                        
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-outline-dark btn-sm">
                            <i class="fas fa-edit mr-2"></i>Modifier
                        </a>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="card shadow">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-folder mr-2"></i>Documents ({{ isset($client->documents) && is_array($client->documents) ? count($client->documents) : 0 }})
                    </h6>
                </div>
                <div class="card-body">
                    @if(isset($client->documents) && is_array($client->documents) && count($client->documents) > 0)
                        <div class="list-group list-group-flush">
                            @foreach(array_slice($client->documents, 0, 5) as $index => $document)
                            @php
                                $extension = strtolower(pathinfo($document['nom'] ?? '', PATHINFO_EXTENSION));
                                $iconClass = 'fa-file';
                                $iconColor = 'text-secondary';
                                if (in_array($extension, ['pdf'])) {
                                    $iconClass = 'fa-file-pdf';
                                    $iconColor = 'text-danger';
                                } elseif (in_array($extension, ['doc', 'docx'])) {
                                    $iconClass = 'fa-file-word';
                                    $iconColor = 'text-primary';
                                } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                    $iconClass = 'fa-file-excel';
                                    $iconColor = 'text-success';
                                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                    $iconClass = 'fa-file-image';
                                    $iconColor = 'text-info';
                                }
                            @endphp
                            <div class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-grow-1">
                                        <i class="fas {{ $iconClass }} {{ $iconColor }} mr-2"></i>
                                        <small class="font-weight-bold">{{ $document['nom'] ?? 'Document' }}</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted mr-2">{{ isset($document['date']) ? \Carbon\Carbon::parse($document['date'])->format('d/m/y') : '' }}</small>
                                        <a href="{{ route('clients.download-document', [$client, $index]) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="Télécharger">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if(count($client->documents) > 5)
                        <div class="text-center mt-3">
                            <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#documentsModal">
                                Voir tous les documents ({{ count($client->documents) }})
                            </button>
                        </div>
                        @endif
                    @else
                        <p class="text-muted text-center mb-0">Aucun document</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gestion des documents -->
<div class="modal fade" id="documentsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-folder-open mr-2"></i>Gestion des documents
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Zone de dépôt -->
                <div id="dropzone" class="border-dashed border-3 rounded p-5 mb-4 text-center bg-light">
                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Glissez-déposez vos documents ici</h5>
                    <p class="text-muted mb-3">ou</p>
                    <label for="fileInput" class="btn btn-primary mb-0">
                        <i class="fas fa-folder-open mr-2"></i>Parcourir les fichiers
                    </label>
                    <input type="file" id="fileInput" multiple class="d-none" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                    <p class="text-muted small mt-2 mb-0">Formats acceptés: PDF, Word, Excel, Images (Max 10MB par fichier)</p>
                </div>

                <!-- Liste des documents -->
                <div id="documentsList">
                    @if(isset($client->documents) && is_array($client->documents) && count($client->documents) > 0)
                        @foreach($client->documents as $index => $document)
                        <div class="document-item border rounded p-3 mb-2" data-index="{{ $index }}">
                            <div class="row align-items-center">
                                <div class="col-md-1 text-center">
                                    @php
                                        $extension = strtolower(pathinfo($document['nom'] ?? '', PATHINFO_EXTENSION));
                                        $iconClass = 'fa-file';
                                        $iconColor = 'text-secondary';
                                        if (in_array($extension, ['pdf'])) {
                                            $iconClass = 'fa-file-pdf';
                                            $iconColor = 'text-danger';
                                        } elseif (in_array($extension, ['doc', 'docx'])) {
                                            $iconClass = 'fa-file-word';
                                            $iconColor = 'text-primary';
                                        } elseif (in_array($extension, ['xls', 'xlsx'])) {
                                            $iconClass = 'fa-file-excel';
                                            $iconColor = 'text-success';
                                        } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                            $iconClass = 'fa-file-image';
                                            $iconColor = 'text-info';
                                        }
                                    @endphp
                                    <i class="fas {{ $iconClass }} fa-2x {{ $iconColor }}"></i>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-sm document-name" 
                                           value="{{ $document['nom'] ?? '' }}" 
                                           data-original="{{ $document['nom'] ?? '' }}">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-control-sm document-type">
                                        <option value="">Type de document</option>
                                        <option value="identite" {{ ($document['type'] ?? '') == 'identite' ? 'selected' : '' }}>Pièce d'identité</option>
                                        <option value="justificatif_domicile" {{ ($document['type'] ?? '') == 'justificatif_domicile' ? 'selected' : '' }}>Justificatif de domicile</option>
                                        <option value="avis_imposition" {{ ($document['type'] ?? '') == 'avis_imposition' ? 'selected' : '' }}>Avis d'imposition</option>
                                        <option value="bulletin_salaire" {{ ($document['type'] ?? '') == 'bulletin_salaire' ? 'selected' : '' }}>Bulletin de salaire</option>
                                        <option value="rib" {{ ($document['type'] ?? '') == 'rib' ? 'selected' : '' }}>RIB</option>
                                        <option value="contrat" {{ ($document['type'] ?? '') == 'contrat' ? 'selected' : '' }}>Contrat</option>
                                        <option value="kbis" {{ ($document['type'] ?? '') == 'kbis' ? 'selected' : '' }}>Kbis</option>
                                        <option value="statuts" {{ ($document['type'] ?? '') == 'statuts' ? 'selected' : '' }}>Statuts</option>
                                        <option value="bilan" {{ ($document['type'] ?? '') == 'bilan' ? 'selected' : '' }}>Bilan</option>
                                        <option value="autre" {{ ($document['type'] ?? '') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control form-control-sm document-date" 
                                           value="{{ $document['date'] ?? '' }}">
                                </div>
                                <div class="col-md-2 text-right">
                                    <a href="{{ route('clients.download-document', [$client, $index]) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="Télécharger"
                                       target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-sm btn-warning btn-replace" 
                                            title="Remplacer"
                                            onclick="replaceDocument({{ $index }})">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete" 
                                            onclick="deleteDocument({{ $index }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2" style="display: none;">
                                <div class="col-md-11 offset-md-1">
                                    <textarea class="form-control form-control-sm document-note" 
                                              placeholder="Notes sur ce document..." rows="2">{{ $document['note'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted" id="noDocuments">Aucun document pour le moment</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Fermer
                </button>
                <button type="button" class="btn btn-primary" onclick="saveDocuments()">
                    <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Historique -->
<div class="card shadow">
    <div class="card-header py-3 bg-dark text-white">
        <h6 class="m-0 font-weight-bold">
            <i class="fas fa-history mr-2"></i>Historique
        </h6>
    </div>
    <div class="card-body">
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-marker bg-primary"></div>
                <div class="timeline-content">
                    <h6 class="timeline-title">Création</h6>
                    <p class="timeline-text">{{ $client->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
            @if($client->updated_at != $client->created_at)
            <div class="timeline-item">
                <div class="timeline-marker bg-warning"></div>
                <div class="timeline-content">
                    <h6 class="timeline-title">Dernière modification</h6>
                    <p class="timeline-text">{{ $client->updated_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
// Gestion du statut
async function updateStatus() {
    const currentStatus = '{{ $client->statut }}';
    const newStatus = currentStatus === 'client' ? 'prospect' : 'client';
    
    const result = await Swal.fire({
        title: 'Changer le statut',
        text: `Voulez-vous changer le statut de ${currentStatus} vers ${newStatus} ?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, changer',
        cancelButtonText: 'Annuler'
    });

    if (result.isConfirmed) {
        try {
            const response = await fetch('{{ route("clients.update-status", $client) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ statut: newStatus })
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire('Succès!', data.message, 'success').then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Erreur!', 'Une erreur est survenue', 'error');
            }
        } catch (error) {
            console.error('Erreur:', error);
            Swal.fire('Erreur!', 'Une erreur est survenue', 'error');
        }
    }
}

// Gestion des documents
let documentsData = @json($client->documents ?? []);
let newDocuments = [];

// Drag & Drop
const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('fileInput');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropzone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropzone.addEventListener(eventName, () => {
        dropzone.classList.add('border-primary', 'bg-white');
    }, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropzone.addEventListener(eventName, () => {
        dropzone.classList.remove('border-primary', 'bg-white');
    }, false);
});

dropzone.addEventListener('drop', handleDrop, false);
fileInput.addEventListener('change', handleFileSelect, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    handleFiles(files);
}

function handleFileSelect(e) {
    const files = e.target.files;
    handleFiles(files);
}

function handleFiles(files) {
    const maxSize = 10 * 1024 * 1024; // 10MB
    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                         'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                         'image/jpeg', 'image/jpg', 'image/png'];

    Array.from(files).forEach(file => {
        if (file.size > maxSize) {
            Swal.fire('Erreur', `Le fichier ${file.name} dépasse 10MB`, 'error');
            return;
        }

        if (!allowedTypes.includes(file.type)) {
            Swal.fire('Erreur', `Le type du fichier ${file.name} n'est pas accepté`, 'error');
            return;
        }

        addDocumentToList(file);
    });

    fileInput.value = '';
}

function addDocumentToList(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        const index = documentsData.length + newDocuments.length;
        const today = new Date().toISOString().split('T')[0];
        
        const extension = file.name.split('.').pop().toLowerCase();
        let iconClass = 'fa-file';
        let iconColor = 'text-secondary';
        
        if (extension === 'pdf') {
            iconClass = 'fa-file-pdf';
            iconColor = 'text-danger';
        } else if (['doc', 'docx'].includes(extension)) {
            iconClass = 'fa-file-word';
            iconColor = 'text-primary';
        } else if (['xls', 'xlsx'].includes(extension)) {
            iconClass = 'fa-file-excel';
            iconColor = 'text-success';
        } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
            iconClass = 'fa-file-image';
            iconColor = 'text-info';
        }

        const html = `
            <div class="document-item border rounded p-3 mb-2 bg-light" data-index="${index}" data-new="true">
                <div class="row align-items-center">
                    <div class="col-md-1 text-center">
                        <i class="fas ${iconClass} fa-2x ${iconColor}"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm document-name" 
                               value="${file.name}" data-original="${file.name}">
                        <small class="text-muted">${formatFileSize(file.size)}</small>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control form-control-sm document-type">
                            <option value="">Type de document</option>
                            <option value="identite">Pièce d'identité</option>
                            <option value="justificatif_domicile">Justificatif de domicile</option>
                            <option value="avis_imposition">Avis d'imposition</option>
                            <option value="bulletin_salaire">Bulletin de salaire</option>
                            <option value="rib">RIB</option>
                            <option value="contrat">Contrat</option>
                            <option value="kbis">Kbis</option>
                            <option value="statuts">Statuts</option>
                            <option value="bilan">Bilan</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control form-control-sm document-date" value="${today}">
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-sm btn-danger btn-delete" onclick="deleteDocument(${index}, true)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('noDocuments')?.remove();
        document.getElementById('documentsList').insertAdjacentHTML('beforeend', html);

        newDocuments.push({
            file: file,
            data: e.target.result,
            index: index
        });
    };
    reader.readAsDataURL(file);
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

function deleteDocument(index, isNew = false) {
    Swal.fire({
        title: 'Confirmer la suppression',
        text: 'Êtes-vous sûr de vouloir supprimer ce document ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            const element = document.querySelector(`.document-item[data-index="${index}"]`);
            element.remove();

            if (isNew) {
                newDocuments = newDocuments.filter(doc => doc.index !== index);
            } else {
                documentsData[index] = { ...documentsData[index], deleted: true };
            }

            if (document.querySelectorAll('.document-item').length === 0) {
                document.getElementById('documentsList').innerHTML = '<p class="text-center text-muted" id="noDocuments">Aucun document pour le moment</p>';
            }
        }
    });
}

function replaceDocument(index) {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png';
    input.onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const maxSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxSize) {
                Swal.fire('Erreur', 'Le fichier dépasse 10MB', 'error');
                return;
            }

            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                 'image/jpeg', 'image/jpg', 'image/png'];
            
            if (!allowedTypes.includes(file.type)) {
                Swal.fire('Erreur', 'Type de fichier non accepté', 'error');
                return;
            }

            // Mise à jour visuelle
            const element = document.querySelector(`.document-item[data-index="${index}"]`);
            const nameInput = element.querySelector('.document-name');
            nameInput.value = file.name;
            
            // Mise à jour de l'icône
            const extension = file.name.split('.').pop().toLowerCase();
            let iconClass = 'fa-file';
            let iconColor = 'text-secondary';
            
            if (extension === 'pdf') {
                iconClass = 'fa-file-pdf';
                iconColor = 'text-danger';
            } else if (['doc', 'docx'].includes(extension)) {
                iconClass = 'fa-file-word';
                iconColor = 'text-primary';
            } else if (['xls', 'xlsx'].includes(extension)) {
                iconClass = 'fa-file-excel';
                iconColor = 'text-success';
            } else if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) {
                iconClass = 'fa-file-image';
                iconColor = 'text-info';
            }
            
            const icon = element.querySelector('.col-md-1 i');
            icon.className = `fas ${iconClass} fa-2x ${iconColor}`;

            // Stocker le fichier de remplacement
            if (!documentsData[index].replacement) {
                documentsData[index].replacement = file;
            } else {
                documentsData[index].replacement = file;
            }

            Swal.fire({
                icon: 'success',
                title: 'Fichier sélectionné',
                text: 'N\'oubliez pas d\'enregistrer vos modifications',
                timer: 2000,
                showConfirmButton: false
            });
        }
    };
    input.click();
}

async function saveDocuments() {
    const formData = new FormData();
    
    // Ajouter les nouveaux fichiers
    newDocuments.forEach((doc, idx) => {
        formData.append(`new_documents[${idx}][file]`, doc.file);
        const element = document.querySelector(`.document-item[data-index="${doc.index}"]`);
        formData.append(`new_documents[${idx}][nom]`, element.querySelector('.document-name').value);
        formData.append(`new_documents[${idx}][type]`, element.querySelector('.document-type').value);
        formData.append(`new_documents[${idx}][date]`, element.querySelector('.document-date').value);
    });

    // Ajouter les modifications des documents existants
    document.querySelectorAll('.document-item:not([data-new])').forEach(element => {
        const index = element.dataset.index;
        if (!documentsData[index].deleted) {
            formData.append(`updated_documents[${index}][nom]`, element.querySelector('.document-name').value);
            formData.append(`updated_documents[${index}][type]`, element.querySelector('.document-type').value);
            formData.append(`updated_documents[${index}][date]`, element.querySelector('.document-date').value);
            const note = element.querySelector('.document-note');
            if (note) {
                formData.append(`updated_documents[${index}][note]`, note.value);
            }
            
            // Ajouter le fichier de remplacement si présent
            if (documentsData[index].replacement) {
                formData.append(`replaced_documents[${index}][file]`, documentsData[index].replacement);
            }
        }
    });

    // Ajouter les documents supprimés
    documentsData.forEach((doc, index) => {
        if (doc.deleted) {
            formData.append(`deleted_documents[]`, index);
        }
    });

    try {
        const response = await fetch('{{ route("clients.update-documents", $client) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            Swal.fire('Succès!', 'Documents mis à jour avec succès', 'success').then(() => {
                location.reload();
            });
        } else {
            Swal.fire('Erreur!', data.message || 'Une erreur est survenue', 'error');
        }
    } catch (error) {
        console.error('Erreur:', error);
        Swal.fire('Erreur!', 'Une erreur est survenue lors de l\'enregistrement', 'error');
    }
}

// Boutons de remplacement de document - SUPPRIMÉ (fonction intégrée ci-dessus)
</script>

<style>
.border-dashed {
    border-style: dashed !important;
    border-width: 2px !important;
    border-color: #d1d3e2 !important;
    transition: all 0.3s ease;
}

.border-dashed:hover {
    border-color: #4e73df !important;
    background-color: #f8f9fc !important;
}

.border-3 {
    border-width: 3px !important;
}

.document-item {
    transition: all 0.2s ease;
}

.document-item:hover {
    background-color: #f8f9fc !important;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -21px;
    top: 20px;
    width: 2px;
    height: calc(100% - 10px);
    background: #e3e6f0;
}

.timeline-marker {
    position: absolute;
    left: -25px;
    top: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.timeline-content {
    margin-left: 0;
}

.timeline-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #5a5c69;
}

.timeline-text {
    font-size: 12px;
    color: #858796;
    margin-bottom: 0;
}

.d-grid {
    display: grid;
}

.gap-2 {
    gap: 0.5rem;
}
</style>
@endsection