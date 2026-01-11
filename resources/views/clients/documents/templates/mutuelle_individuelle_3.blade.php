@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mutuelle_individuelle_3']) }}" method="POST">
        @csrf
        @php        
            $data2=\App\Models\ClientDocumentData::where('client_id',$client->id)->where('template_key','mutuelle_individuelle_2')->first();
        @endphp
        <input type="hidden" name="nom_complet" value="{{ $client->nom_complet }}">

        <div class="card mb-3">
            <div class="card-header">I – Phase de préconisation</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>1/ Rappel des exigences et besoins exprimés</label>
                    <textarea name="rappel_besoins" class="form-control" rows="4" required placeholder="Ex: Mr présente un besoin spécifique lié à son changement de statut...">{{  $data2->data['description_besoin'] ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label>2/ Produit(s) préconisé(s)</label>
                    <input type="text" name="produit_preconise" class="form-control" required placeholder="Ex: Contrat Santé TNS" value="{{ $data['produit_preconise'] ?? '' }}" >
                </div>

                <div class="mb-3">
                    <label>Commercialisé par la société</label>
                    <select name="compagnie" class="form-control" required>
                        <option value="" @selected($data['compagnie'] == "" )>Sélectionner une compagnie</option>
                        <option value="SWISSLIFE" @selected($data['compagnie'] == "SWISSLIFE" )>SWISSLIFE</option>
                        <option value="MALAKOFF HUMANIS" @selected($data['compagnie'] == "MALAKOFF HUMANIS" )>MALAKOFF HUMANIS</option>
                        <option value="AESIO" @selected($data['compagnie'] == "AESIO" )>AESIO</option>
                        <option value="SPVIE" @selected($data['compagnie'] == "SPVIE" )>SPVIE</option>
                        <option value="ZEPHIR" @selected($data['compagnie'] == "ZEPHIR" )>ZEPHIR</option>
                        <option value="ALPTIS" @selected($data['compagnie'] == "ALPTIS" )>ALPTIS</option>
                        <option value="CEGEMA" @selected($data['compagnie'] == "CEGEMA" )>CEGEMA</option>
                        <option value="MODULASSUR" @selected($data['compagnie'] == "MODULASSUR" )>MODULASSUR</option>
                        <option value="ZENIOO" @selected($data['compagnie'] == "ZENIOO" )>ZENIOO</option>
                        <option value="ACPS" @selected($data['compagnie'] == "ACPS" )>ACPS</option>
                        <option value="Ilona" @selected($data['compagnie'] == "Ilona" )>Ilona</option>
                        <option value="ECA" @selected($data['compagnie'] == "ECA" )>ECA</option>
                        <option value="ENTORIA" @selected($data['compagnie'] == "ENTORIA" )>ENTORIA</option>
                        <option value="APICIL" @selected($data['compagnie'] == "APICIL" )>APICIL</option>
                        <option value="HUMINDIS" @selected($data['compagnie'] == "HUMINDIS" )>HUMINDIS</option>
                        <option value="TUTASSUR" @selected($data['compagnie'] == "TUTASSUR" )>TUTASSUR</option>
                        <option value="LUXIOR" @selected($data['compagnie'] == "LUXIOR" )>LUXIOR</option>
                        <option value="ASAF AFPS" @selected($data['compagnie'] == "ASAF AFPS" )>ASAF AFPS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>3/ Documents remis au client</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_etude_comparative" id="doc1" value="1"  {{ isset($data['doc_etude_comparative']) && ($data['doc_etude_comparative'] ==1)   ? 'checked' : '' }}>
                        <label class="form-check-label" for="doc1">Étude comparative</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_devis" id="doc2" value="1"  {{ isset($data['doc_devis']) && ($data['doc_devis'] ==1)   ? 'checked' : '' }}>
                        <label class="form-check-label" for="doc2">Devis</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_conditions_generales" id="doc3" value="1"  {{ isset($data['doc_conditions_generales']) && ($data['doc_conditions_generales'] ==1)  ? 'checked' : '' }}>
                        <label class="form-check-label" for="doc3">Conditions générales</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_ipid" id="doc4" value="1" {{isset($data['doc_ipid']) && ($data['doc_ipid'] ==1)  ? 'checked' : '' }}>
                        <label class="form-check-label" for="doc4">IPID</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_fsi" id="doc5" value="1" {{ isset($data['doc_fsi']) && ($data['doc_fsi'] ==1)    ? 'checked' : '' }}>
                        <label class="form-check-label" for="doc5">FSI</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">II – Phase de justification</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Motivation du conseil</label>
                    <textarea name="motivation_conseil" class="form-control" rows="4" required placeholder="Ce contrat vous est préconisé pour les raisons suivantes...">{{ $data['motivation_conseil'] ?? '' }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Adéquation au marché cible</label>
                    <select name="adequation_marche" class="form-control" required>
                        <option value="">Sélectionner</option>
                        <option value="Oui" @selected($data['adequation_marche'] == "Oui" )>Oui</option>
                        <option value="Non" @selected($data['adequation_marche'] == "Non" )>Non</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Si non, pourquoi ?</label>
                    <textarea name="raison_non_adequation" class="form-control" rows="2">{{ $data['raison_non_adequation'] ?? '' }}</textarea>
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