@extends('layouts.admin')

@section('title', 'Nouveau Client/Prospect')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-user-plus mr-2"></i>Nouveau Client / Prospect
                    </h2>
                    <p class="text-muted mb-0">Création d'un nouveau client ou prospect</p>
                </div>
                <div>
                    <a class="btn btn-secondary" href="{{ route('clients.index') }}">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire principal -->
    <form action="{{ route('clients.store') }}" method="POST" id="clientForm">
        @csrf
        
        <!-- Card Type de client et Statut -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-user-tag mr-2"></i>Type et Statut
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Type de client -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Type de client <span class="text-danger">*</span></label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="particulier" 
                                       value="particulier" {{ old('type', 'particulier') == 'particulier' ? 'checked' : '' }}
                                       onchange="toggleClientType()">
                                <label class="form-check-label" for="particulier">
                                    <i class="fas fa-user mr-1"></i>Particulier
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="entreprise" 
                                       value="entreprise" {{ old('type') == 'entreprise' ? 'checked' : '' }}
                                       onchange="toggleClientType()">
                                <label class="form-check-label" for="entreprise">
                                    <i class="fas fa-building mr-1"></i>Entreprise
                                </label>
                            </div>
                        </div>
                        @error('type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="col-md-6 mb-3">
                        <label for="statut" class="form-label font-weight-bold">Statut <span class="text-danger">*</span></label>
                        <select name="statut" id="statut" class="form-control">
                            <option value="prospect" {{ old('statut', 'prospect') == 'prospect' ? 'selected' : '' }}>Prospect</option>
                            <option value="client" {{ old('statut') == 'client' ? 'selected' : '' }}>Client</option>
                        </select>
                        @error('statut')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Informations générales -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-info text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Informations générales
                </h6>
            </div>
            <div class="card-body">
                
                <!-- Champs Particulier -->
                <div id="particulier-fields" style="display: {{ old('type', 'particulier') == 'particulier' ? 'block' : 'none' }}">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="civilite" class="form-label font-weight-bold">Civilité <span class="text-danger">*</span></label>
                            <select name="civilite" id="civilite" class="form-control">
                                <option value="">Sélectionner</option>
                                <option value="M" {{ old('civilite') == 'M' ? 'selected' : '' }}>M.</option>
                                <option value="Mme" {{ old('civilite') == 'Mme' ? 'selected' : '' }}>Mme</option>
                                <option value="Mlle" {{ old('civilite') == 'Mlle' ? 'selected' : '' }}>Mlle</option>
                            </select>
                            @error('civilite')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="nom" class="form-label font-weight-bold">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control">
                            @error('nom')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="prenom" class="form-label font-weight-bold">Prénom <span class="text-danger">*</span></label>
                            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="form-control">
                            @error('prenom')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="date_naissance" class="form-label font-weight-bold">Date de naissance</label>
                            <input type="date" name="date_naissance" id="date_naissance" 
                                   value="{{ old('date_naissance') }}" class="form-control">
                            @error('date_naissance')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nationalite" class="form-label font-weight-bold">Nationalité</label>
                            <input type="text" name="nationalite" id="nationalite" value="{{ old('nationalite') }}" class="form-control" placeholder="Française">
                            @error('nationalite')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="situation_familiale" class="form-label font-weight-bold">Situation familiale</label>
                            <select name="situation_familiale" id="situation_familiale" class="form-control">
                                <option value="">Sélectionner</option>
                                <option value="celibataire" {{ old('situation_familiale') == 'celibataire' ? 'selected' : '' }}>Célibataire</option>
                                <option value="marie" {{ old('situation_familiale') == 'marie' ? 'selected' : '' }}>Marié(e)</option>
                                <option value="pacs" {{ old('situation_familiale') == 'pacs' ? 'selected' : '' }}>Pacsé(e)</option>
                                <option value="divorce" {{ old('situation_familiale') == 'divorce' ? 'selected' : '' }}>Divorcé(e)</option>
                                <option value="veuf" {{ old('situation_familiale') == 'veuf' ? 'selected' : '' }}>Veuf(ve)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="regime_matrimonial" class="form-label font-weight-bold">Régime matrimonial</label>
                            <select name="regime_matrimonial" id="regime_matrimonial" class="form-control">
                                <option value="">Sélectionner</option>
                                <option value="communaute_reduite_acquets" {{ old('regime_matrimonial') == 'communaute_reduite_acquets' ? 'selected' : '' }}>Communauté réduite aux acquêts</option>
                                <option value="separation_biens" {{ old('regime_matrimonial') == 'separation_biens' ? 'selected' : '' }}>Séparation de biens</option>
                                <option value="communaute_universelle" {{ old('regime_matrimonial') == 'communaute_universelle' ? 'selected' : '' }}>Communauté universelle</option>
                                <option value="participation_acquets" {{ old('regime_matrimonial') == 'participation_acquets' ? 'selected' : '' }}>Participation aux acquêts</option>
                            </select>
                        </div>
                    </div>

                    <!-- Enfants -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-secondary mb-0">
                            <i class="fas fa-child mr-2"></i>Enfants
                        </h5>
                        <button type="button" class="btn btn-sm btn-success" onclick="addEnfant()">
                            <i class="fas fa-plus mr-1"></i>Ajouter un enfant
                        </button>
                    </div>
                    <div id="enfants-container"></div>
                </div>

                <!-- Champs Entreprise -->
                <div id="entreprise-fields" style="display: {{ old('type') == 'entreprise' ? 'block' : 'none' }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="raison_sociale" class="form-label font-weight-bold">Raison sociale <span class="text-danger">*</span></label>
                            <input type="text" name="raison_sociale" id="raison_sociale" 
                                   value="{{ old('raison_sociale') }}" class="form-control">
                            @error('raison_sociale')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="statut_juridique" class="form-label font-weight-bold">Statut juridique</label>
                            <select name="statut_juridique" id="statut_juridique" class="form-control">
                                <option value="">Sélectionner</option>
                                <option value="SARL" {{ old('statut_juridique') == 'SARL' ? 'selected' : '' }}>SARL</option>
                                <option value="SAS" {{ old('statut_juridique') == 'SAS' ? 'selected' : '' }}>SAS</option>
                                <option value="SA" {{ old('statut_juridique') == 'SA' ? 'selected' : '' }}>SA</option>
                                <option value="EURL" {{ old('statut_juridique') == 'EURL' ? 'selected' : '' }}>EURL</option>
                                <option value="Auto-entrepreneur" {{ old('statut_juridique') == 'Auto-entrepreneur' ? 'selected' : '' }}>Auto-entrepreneur</option>
                                <option value="SCI" {{ old('statut_juridique') == 'SCI' ? 'selected' : '' }}>SCI</option>
                                <option value="Autre" {{ old('statut_juridique') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="siret-input" class="form-label font-weight-bold">SIRET</label>
                            <input type="text" name="siret" id="siret-input" value="{{ old('siret') }}" class="form-control" placeholder="12345678901234">
                            @error('siret')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nombre_associes" class="form-label font-weight-bold">Nombre d'associés</label>
                            <input type="number" name="nombre_associes" id="nombre_associes" value="{{ old('nombre_associes') }}" class="form-control" min="1">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="secteur_activite" class="form-label font-weight-bold">Secteur d'activité</label>
                            <textarea name="secteur_activite" id="secteur_activite" rows="3" class="form-control" placeholder="Décrivez le secteur d'activité de l'entreprise...">{{ old('secteur_activite') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="repartition_capital" class="form-label font-weight-bold">Répartition du capital social</label>
                            <textarea name="repartition_capital" id="repartition_capital" rows="3" class="form-control" placeholder="Ex: Associé 1 - 50%, Associé 2 - 30%, Associé 3 - 20%">{{ old('repartition_capital') }}</textarea>
                        </div>
                    </div>

                    <!-- Associés -->
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="text-secondary mb-0">
                            <i class="fas fa-users mr-2"></i>Informations des associés
                        </h5>
                        <button type="button" class="btn btn-sm btn-success" onclick="addAssocie()">
                            <i class="fas fa-plus mr-1"></i>Ajouter un associé
                        </button>
                    </div>
                    <div id="associes-container"></div>

                    <!-- Éléments financiers entreprise -->
                    <hr class="my-4">
                    <h5 class="text-secondary mb-3">
                        <i class="fas fa-chart-line mr-2"></i>Éléments financiers
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="ca_entreprise" class="form-label font-weight-bold">Chiffre d'affaires (€)</label>
                            <div class="input-group">
                                <input type="number" name="ca_entreprise" id="ca_entreprise" value="{{ old('ca_entreprise') }}" 
                                       step="0.01" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="rn_entreprise" class="form-label font-weight-bold">Résultat net (€)</label>
                            <div class="input-group">
                                <input type="number" name="rn_entreprise" id="rn_entreprise" value="{{ old('rn_entreprise') }}" 
                                       step="0.01" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="valorisation_entreprise" class="form-label font-weight-bold">Valorisation (€)</label>
                            <div class="input-group">
                                <input type="number" name="valorisation_entreprise" id="valorisation_entreprise" value="{{ old('valorisation_entreprise') }}" 
                                       step="0.01" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coordonnées communes -->
                <hr class="my-4">
                <h5 class="text-secondary mb-3">
                    <i class="fas fa-address-card mr-2"></i>Coordonnées
                </h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label font-weight-bold">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="telephone" class="form-label font-weight-bold">Téléphone</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="telephone_portable" class="form-label font-weight-bold">Portable</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                            </div>
                            <input type="tel" name="telephone_portable" id="telephone_portable" 
                                   value="{{ old('telephone_portable') }}" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="adresse" class="form-label font-weight-bold">Adresse</label>
                        <textarea name="adresse" id="adresse" rows="2" class="form-control">{{ old('adresse') }}</textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="code_postal" class="form-label font-weight-bold">Code postal</label>
                        <input type="text" name="code_postal" id="code_postal" value="{{ old('code_postal') }}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="ville" class="form-label font-weight-bold">Ville</label>
                        <input type="text" name="ville" id="ville" value="{{ old('ville') }}" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pays" class="form-label font-weight-bold">Pays</label>
                        <input type="text" name="pays" id="pays" value="{{ old('pays') }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Situation financière (Particulier seulement) -->
        <div id="situation-financiere" class="card shadow mb-4" style="display: {{ old('type', 'particulier') == 'particulier' ? 'block' : 'none' }}">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-euro-sign mr-2"></i>Situation financière
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Revenus</h6>
                    <button type="button" class="btn btn-sm btn-success" onclick="addRevenu()">
                        <i class="fas fa-plus mr-1"></i>Ajouter un revenu
                    </button>
                </div>
                <div id="revenus-container"></div>
            </div>
        </div>

        <!-- Card Situation professionnelle (Particulier seulement) -->
        <div id="situation-pro" class="card shadow mb-4" style="display: {{ old('type', 'particulier') == 'particulier' ? 'block' : 'none' }}">
            <div class="card-header py-3 bg-success text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-briefcase mr-2"></i>Situation professionnelle
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="profession" class="form-label font-weight-bold">Profession</label>
                        <input type="text" name="profession" id="profession" value="{{ old('profession') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employeur" class="form-label font-weight-bold">Employeur</label>
                        <input type="text" name="employeur" id="employeur" value="{{ old('employeur') }}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type_contrat" class="form-label font-weight-bold">Type de contrat</label>
                        <select name="type_contrat" id="type_contrat" class="form-control">
                            <option value="">Sélectionner</option>
                            <option value="cdi" {{ old('type_contrat') == 'cdi' ? 'selected' : '' }}>CDI</option>
                            <option value="cdd" {{ old('type_contrat') == 'cdd' ? 'selected' : '' }}>CDD</option>
                            <option value="interim" {{ old('type_contrat') == 'interim' ? 'selected' : '' }}>Intérim</option>
                            <option value="freelance" {{ old('type_contrat') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="retraite" {{ old('type_contrat') == 'retraite' ? 'selected' : '' }}>Retraité</option>
                            <option value="chomage" {{ old('type_contrat') == 'chomage' ? 'selected' : '' }}>Chômage</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Patrimoine (Particulier seulement) -->
        <div id="patrimoine" class="card shadow mb-4" style="display: {{ old('type', 'particulier') == 'particulier' ? 'block' : 'none' }}">
            <div class="card-header py-3 bg-warning text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-coins mr-2"></i>Patrimoine
                </h6>
            </div>
            <div class="card-body">
                <!-- Immobilier -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-primary">
                            <i class="fas fa-home mr-2"></i>Immobilier
                        </h5>
                        <button type="button" class="btn btn-sm btn-primary" onclick="addImmobilier()">
                            <i class="fas fa-plus mr-1"></i>Ajouter un bien
                        </button>
                    </div>
                    <div id="immobilier-container"></div>
                </div>

                <hr class="my-4">

                <!-- Mobilier -->
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-success">
                            <i class="fas fa-wallet mr-2"></i>Mobilier
                        </h5>
                        <button type="button" class="btn btn-sm btn-success" onclick="addMobilier()">
                            <i class="fas fa-plus mr-1"></i>Ajouter un contrat
                        </button>
                    </div>
                    <div id="mobilier-container"></div>
                </div>
            </div>
        </div>

        <!-- Card Commentaires -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-secondary text-white">
                <h6 class="m-0 font-weight-bold">
                    <i class="fas fa-comments mr-2"></i>Commentaires
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Historique des commentaires</h6>
                    <button type="button" class="btn btn-sm btn-primary" onclick="addCommentaire()">
                        <i class="fas fa-plus mr-1"></i>Ajouter un commentaire
                    </button>
                </div>
                <div id="commentaires-container"></div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary mr-2">
                            <i class="fas fa-times mr-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('footer-scripts')
<script>
let enfantIndex = 0;
let associeIndex = 0;
let revenuIndex = 0;
let immobilierIndex = 0;
let mobilierIndex = 0;
let commentaireIndex = 0;

function toggleClientType() {
    const type = document.querySelector('input[name="type"]:checked').value;
    const particulierFields = document.getElementById('particulier-fields');
    const entrepriseFields = document.getElementById('entreprise-fields');
    const situationFinanciere = document.getElementById('situation-financiere');
    const situationPro = document.getElementById('situation-pro');
    const patrimoine = document.getElementById('patrimoine');
    
    if (type === 'particulier') {
        particulierFields.style.display = 'block';
        entrepriseFields.style.display = 'none';
        situationFinanciere.style.display = 'block';
        situationPro.style.display = 'block';
        patrimoine.style.display = 'block';
    } else {
        particulierFields.style.display = 'none';
        entrepriseFields.style.display = 'block';
        situationFinanciere.style.display = 'none';
        situationPro.style.display = 'none';
        patrimoine.style.display = 'none';
    }
}

function addEnfant() {
    const container = document.getElementById('enfants-container');
    const html = `
        <div class="enfant-row border rounded p-3 mb-3 bg-light" data-index="${enfantIndex}">
            <div class="row">
                <div class="col-md-2">
                    <label class="form-label font-weight-bold">Civilité</label>
                    <select name="enfants[${enfantIndex}][civilite]" class="form-control form-control-sm">
                        <option value="">-</option>
                        <option value="M">M.</option>
                        <option value="Mme">Mme</option>
                        <option value="Mlle">Mlle</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Nom</label>
                    <input type="text" name="enfants[${enfantIndex}][nom]" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Prénom</label>
                    <input type="text" name="enfants[${enfantIndex}][prenom]" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Date de naissance</label>
                    <input type="date" name="enfants[${enfantIndex}][date_naissance]" class="form-control form-control-sm">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeEnfant(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    enfantIndex++;
}

function removeEnfant(btn) {
    btn.closest('.enfant-row').remove();
}

function addAssocie() {
    const container = document.getElementById('associes-container');
    const html = `
        <div class="associe-row border rounded p-3 mb-3 bg-light" data-index="${associeIndex}">
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Prénom</label>
                    <input type="text" name="associes[${associeIndex}][prenom]" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Nom</label>
                    <input type="text" name="associes[${associeIndex}][nom]" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label class="form-label font-weight-bold">Date de naissance</label>
                    <input type="date" name="associes[${associeIndex}][date_naissance]" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Adresse</label>
                    <input type="text" name="associes[${associeIndex}][adresse]" class="form-control form-control-sm">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeAssocie(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    associeIndex++;
}

function removeAssocie(btn) {
    btn.closest('.associe-row').remove();
}

function addRevenu() {
    const container = document.getElementById('revenus-container');
    const html = `
        <div class="revenu-row border rounded p-3 mb-3 bg-light" data-index="${revenuIndex}">
            <div class="row">
                <div class="col-md-5">
                    <label class="form-label font-weight-bold">Type de revenu</label>
                    <select name="revenus_details[${revenuIndex}][type]" class="form-control">
                        <option value="">Sélectionner</option>
                        <option value="salaire">Salaire</option>
                        <option value="bic">BIC (Bénéfices Industriels et Commerciaux)</option>
                        <option value="bnc">BNC (Bénéfices Non Commerciaux)</option>
                        <option value="remuneration_gerance">Rémunération de gérance</option>
                        <option value="revenus_fonciers">Revenus fonciers</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label font-weight-bold">Montant annuel (€)</label>
                    <div class="input-group">
                        <input type="number" name="revenus[${revenuIndex}][montant]" step="0.01" class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRevenu(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    revenuIndex++;
}

function removeRevenu(btn) {
    btn.closest('.revenu-row').remove();
}

function addImmobilier() {
    const container = document.getElementById('immobilier-container');
    const html = `
        <div class="immobilier-row border rounded p-3 mb-3 bg-light" data-index="${immobilierIndex}">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Type de bien</label>
                    <select name="patrimoine_immobilier[${immobilierIndex}][type_bien]" class="form-control form-control-sm">
                        <option value="">Sélectionner</option>
                        <option value="maison">Maison</option>
                        <option value="appartement">Appartement</option>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label font-weight-bold">Usage</label>
                    <select name="patrimoine_immobilier[${immobilierIndex}][usage]" class="form-control form-control-sm">
                        <option value="">-</option>
                        <option value="rp">RP</option>
                        <option value="rl">RL</option>
                        <option value="rs">RS</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Destination</label>
                    <select name="patrimoine_immobilier[${immobilierIndex}][destination]" class="form-control form-control-sm">
                        <option value="">-</option>
                        <option value="habitation">Habitation</option>
                        <option value="bureau">Bureau</option>
                        <option value="local_professionnel">Local professionnel</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Date d'achat</label>
                    <input type="date" name="patrimoine_immobilier[${immobilierIndex}][date_achat]" class="form-control form-control-sm">
                </div>
                <div class="col-md-1 mb-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeImmobilier(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Valeur d'achat (€)</label>
                    <input type="number" name="patrimoine_immobilier[${immobilierIndex}][valeur_achat]" step="0.01" class="form-control form-control-sm">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Valeur actuelle (€)</label>
                    <input type="number" name="patrimoine_immobilier[${immobilierIndex}][valeur_actuelle]" step="0.01" class="form-control form-control-sm">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Capital restant dû (€)</label>
                    <input type="number" name="patrimoine_immobilier[${immobilierIndex}][capital_restant]" step="0.01" class="form-control form-control-sm">
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Annuité (€)</label>
                    <input type="number" name="patrimoine_immobilier[${immobilierIndex}][annuite]" step="0.01" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Date de fin du prêt</label>
                    <input type="date" name="patrimoine_immobilier[${immobilierIndex}][date_fin_pret]" class="form-control form-control-sm">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    immobilierIndex++;
}

function removeImmobilier(btn) {
    btn.closest('.immobilier-row').remove();
}

function addMobilier() {
    const container = document.getElementById('mobilier-container');
    const html = `
        <div class="mobilier-row border rounded p-3 mb-3 bg-light" data-index="${mobilierIndex}">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="form-label font-weight-bold">Type de contrat</label>
                    <select name="patrimoine_mobilier[${mobilierIndex}][type_contrat]" class="form-control form-control-sm">
                        <option value="">Sélectionner</option>
                        <option value="per">PER</option>
                        <option value="assurance_vie">Assurance Vie</option>
                        <option value="livret">Livret</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Montant (€)</label>
                    <input type="number" name="patrimoine_mobilier[${mobilierIndex}][montant]" step="0.01" class="form-control form-control-sm">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label font-weight-bold">Établissement</label>
                    <input type="text" name="patrimoine_mobilier[${mobilierIndex}][etablissement]" class="form-control form-control-sm">
                </div>
                <div class="col-md-1 mb-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeMobilier(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    mobilierIndex++;
}

function removeMobilier(btn) {
    btn.closest('.mobilier-row').remove();
}

function addCommentaire() {
    const container = document.getElementById('commentaires-container');
    const now = new Date();
    const dateTimeLocal = now.toISOString().slice(0, 16);
    
    const html = `
        <div class="commentaire-row border rounded p-3 mb-3 bg-light" data-index="${commentaireIndex}">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label font-weight-bold">Date</label>
                    <input type="datetime-local" name="commentaires[${commentaireIndex}][date]" value="${dateTimeLocal}" class="form-control form-control-sm">
                </div>
                <div class="col-md-8 mb-2">
                    <label class="form-label font-weight-bold">Commentaire</label>
                    <textarea name="commentaires[${commentaireIndex}][texte]" rows="2" class="form-control form-control-sm"></textarea>
                </div>
                <div class="col-md-1 mb-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeCommentaire(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    commentaireIndex++;
}

function removeCommentaire(btn) {
    btn.closest('.commentaire-row').remove();
}
</script>
@endsection