@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $templateName }}</h2>
    <p class="text-muted">Client : {{ $client->nom_complet }}</p>

    <form action="{{ route('clients.documents.generate', [$client, 'mutuelle_individuelle_3']) }}" method="POST">
        @csrf

        <input type="hidden" name="nom_complet" value="{{ $client->nom_complet }}">

        <div class="card mb-3">
            <div class="card-header">I – Phase de préconisation</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>1/ Rappel des exigences et besoins exprimés</label>
                    <textarea name="rappel_besoins" class="form-control" rows="4" required placeholder="Ex: Mr présente un besoin spécifique lié à son changement de statut..."></textarea>
                </div>

                <div class="mb-3">
                    <label>2/ Produit(s) préconisé(s)</label>
                    <input type="text" name="produit_preconise" class="form-control" required placeholder="Ex: Contrat Santé TNS">
                </div>

                <div class="mb-3">
                    <label>Commercialisé par la société</label>
                    <select name="compagnie" class="form-control" required>
                        <option value="">Sélectionner une compagnie</option>
                        <option value="SWISSLIFE">SWISSLIFE</option>
                        <option value="MALAKOFF HUMANIS">MALAKOFF HUMANIS</option>
                        <option value="AESIO">AESIO</option>
                        <option value="SPVIE">SPVIE</option>
                        <option value="ZEPHIR">ZEPHIR</option>
                        <option value="ALPTIS">ALPTIS</option>
                        <option value="CEGEMA">CEGEMA</option>
                        <option value="MODULASSUR">MODULASSUR</option>
                        <option value="ZENIOO">ZENIOO</option>
                        <option value="ACPS">ACPS</option>
                        <option value="Ilona">Ilona</option>
                        <option value="ECA">ECA</option>
                        <option value="ENTORIA">ENTORIA</option>
                        <option value="APICIL">APICIL</option>
                        <option value="HUMINDIS">HUMINDIS</option>
                        <option value="TUTASSUR">TUTASSUR</option>
                        <option value="LUXIOR">LUXIOR</option>
                        <option value="ASAF AFPS">ASAF AFPS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>3/ Documents remis au client</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_etude_comparative" id="doc1" value="1">
                        <label class="form-check-label" for="doc1">Étude comparative</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_devis" id="doc2" value="1">
                        <label class="form-check-label" for="doc2">Devis</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_conditions_generales" id="doc3" value="1">
                        <label class="form-check-label" for="doc3">Conditions générales</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_ipid" id="doc4" value="1">
                        <label class="form-check-label" for="doc4">IPID</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="doc_fsi" id="doc5" value="1">
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
                    <textarea name="motivation_conseil" class="form-control" rows="4" required placeholder="Ce contrat vous est préconisé pour les raisons suivantes..."></textarea>
                </div>

                <div class="mb-3">
                    <label>Adéquation au marché cible</label>
                    <select name="adequation_marche" class="form-control" required>
                        <option value="">Sélectionner</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Si non, pourquoi ?</label>
                    <textarea name="raison_non_adequation" class="form-control" rows="2"></textarea>
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