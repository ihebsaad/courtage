<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mandat de Recherche de Bien Immobilier</title>
    <style>
        @page { margin: 80px 50px 100px 50px; }
        body { font-family: Arial, sans-serif; font-size: 10px; line-height: 1.4; }
        .header-box { padding: 8px; margin-bottom: 15px; text-align: center; font-size: 8px; line-height: 1.4; margin-top: -80px; }
        .title { font-size: 18px; font-weight: bold; text-align: center; margin: 15px 0; border-bottom: 2px solid #000; padding-bottom: 5px; }
        .section { margin-bottom: 15px; }
        .section-title { font-weight: bold; background-color: #000; color: #fff; padding: 6px 10px; margin-bottom: 10px; font-size: 11px; }
        .subsection-title { font-weight: bold; margin-top: 10px; margin-bottom: 5px; text-decoration: underline; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }
        
        .field { margin-bottom: 8px; }
        .field-label { font-weight: bold; display: inline-block; min-width: 150px; }
        .field-value { display: inline-block; }
        .box { border: 1px solid #000; padding: 10px; margin: 10px 0; }
        .highlight-box { background-color: #000; color: #fff; padding: 10px; margin: 10px 0; font-weight: bold; }
        table.info-table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        table.info-table td { padding: 5px; border: 1px solid #000; }
        .signature-area { margin-top: 30px; page-break-inside: avoid; }
        table.signatures { width: 100%; }
        table.signatures td { width: 50%; text-align: center; padding: 5px; vertical-align: top; }
        .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid #000; margin-right: 5px; vertical-align: middle; }
        .checkbox.checked::before { content: 'X'; font-weight: bold; font-size: 11px; }
        ul { margin: 5px 0 5px 20px; padding: 0; }
        li { margin-bottom: 3px; }
    </style>
</head>
<body>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="80" />
    </div>

    <div class="title">MANDAT DE RECHERCHE DE BIEN IMMOBILIER</div>

    <div class="section">
        <div class="section-title">IDENTIFICATION DU MANDANT</div>
        
        <div class="field">
            <span class="field-label">Civilité :</span>
            <span class="field-value">{{ $client->civilite ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Nom :</span>
            <span class="field-value">{{ $client->nom ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Prénom :</span>
            <span class="field-value">{{ $client->prenom ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Date de naissance :</span>
            <span class="field-value">{{ $client->date_naissance?->format('d/m/Y') ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Adresse :</span>
            <span class="field-value">{{ $client->adresse_complete ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Email :</span>
            <span class="field-value">{{ $client->email ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Téléphone :</span>
            <span class="field-value">{{ $client->telephone_portable ?? $client->telephone ?? '' }}</span>
        </div>

        @if(!empty($data['conjoint_nom']) || !empty($data['conjoint_prenom']))
        <div class="subsection-title">Conjoint / Co-acquéreur</div>
        <div class="field">
            <span class="field-label">Civilité :</span>
            <span class="field-value">{{ $data['conjoint_civilite'] ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Nom :</span>
            <span class="field-value">{{ $data['conjoint_nom'] ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Prénom :</span>
            <span class="field-value">{{ $data['conjoint_prenom'] ?? '' }}</span>
        </div>
        <div class="field">
            <span class="field-label">Date de naissance :</span>
            <span class="field-value">{{ isset($data['conjoint_date_naissance']) ? \Carbon\Carbon::parse($data['conjoint_date_naissance'])->format('d/m/Y') : '' }}</span>
        </div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">OBJET DU MANDAT</div>
        <p>
            Le mandant confie au mandataire la mission de rechercher un bien immobilier correspondant aux critères 
            définis ci-après, et de lui présenter les biens correspondants.
        </p>
    </div>

    <div class="section">
        <div class="section-title">CARACTÉRISTIQUES DU BIEN RECHERCHÉ</div>
        
        <div class="highlight-box">
            <div class="field">
                <span class="field-label">Nature du bien :</span>
                <span class="field-value">{{ $data['nature_bien'] ?? '' }}</span>
            </div>
        </div>

        <div class="highlight-box">
            <div class="field">
                <span class="field-label">Localisation recherchée :</span>
                <span class="field-value">{{ $data['localisation'] ?? '' }}</span>
            </div>
        </div>

        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <strong>Surface souhaitée :</strong> {{ $data['surface_souhaitee'] ?? '' }} m²
                </td>
                <td style="width: 50%;">
                    <strong>Nombre de pièces :</strong> {{ $data['nombre_pieces'] ?? '' }}
                </td>
            </tr>
        </table>

        <div class="highlight-box">
            <div class="field">
                <span class="field-label">Budget minimum :</span>
                <span class="field-value">{{ number_format($data['budget_min'] ?? 0, 0, ',', ' ') }} €</span>
            </div>
            <div class="field">
                <span class="field-label">Budget maximum :</span>
                <span class="field-value">{{ number_format($data['budget_max'] ?? 0, 0, ',', ' ') }} €</span>
            </div>
        </div>

        @if(!empty($data['criteres_supplementaires']))
        <div class="subsection-title">Critères spécifiques recherchés</div>
        <div class="box">
            {{ $data['criteres_supplementaires'] }}
        </div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">FINANCEMENT DU PROJET</div>
        
        <div class="field">
            <span class="field-label">Apport personnel :</span>
            <span class="field-value">{{ !empty($data['apport_personnel']) ? number_format($data['apport_personnel'], 0, ',', ' ') . ' €' : 'Non renseigné' }}</span>
        </div>
        
        <div class="field">
            <span class="field-label">Capacité d'emprunt mensuelle :</span>
            <span class="field-value">{{ !empty($data['capacite_emprunt']) ? number_format($data['capacite_emprunt'], 0, ',', ' ') . ' €/mois' : 'Non renseigné' }}</span>
        </div>
        
        <div class="field">
            <span class="field-label">Accord de principe bancaire :</span>
            @if(($data['accord_bancaire'] ?? 'non') === 'oui')
                <span class="checkbox checked"></span> Oui
                <span class="checkbox"></span> Non
                <span class="checkbox"></span> En cours
            @elseif(($data['accord_bancaire'] ?? 'non') === 'en_cours')
                <span class="checkbox"></span> Oui
                <span class="checkbox"></span> Non
                <span class="checkbox checked"></span> En cours
            @else
                <span class="checkbox"></span> Oui
                <span class="checkbox checked"></span> Non
                <span class="checkbox"></span> En cours
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">DÉLAI ET DISPONIBILITÉ</div>
        
        <div class="field">
            <span class="field-label">Délai souhaité pour l'acquisition :</span>
            <span class="field-value">
                @switch($data['delai_acquisition'] ?? 'moyen_terme')
                    @case('immediat')
                        Immédiat (moins de 3 mois)
                        @break
                    @case('court_terme')
                        Court terme (3-6 mois)
                        @break
                    @case('moyen_terme')
                        Moyen terme (6-12 mois)
                        @break
                    @case('long_terme')
                        Long terme (plus de 12 mois)
                        @break
                @endswitch
            </span>
        </div>
        
        <div class="field">
            <span class="field-label">Disponibilité pour les visites :</span>
            <span class="field-value">{{ $data['disponibilite_visites'] ?? 'À définir' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">DURÉE DU MANDAT</div>
        
        <div class="highlight-box">
            <div class="field">
                <span class="field-label">Date de début :</span>
                <span class="field-value">{{ \Carbon\Carbon::parse($data['date_debut_mandat'])->format('d/m/Y') }}</span>
            </div>
            <div class="field">
                <span class="field-label">Date de fin :</span>
                <span class="field-value">{{ \Carbon\Carbon::parse($data['date_fin_mandat'])->format('d/m/Y') }}</span>
            </div>
        </div>
        
        <p style="margin-top: 10px;">
            Le présent mandat est conclu pour une durée déterminée. Il pourra être renouvelé par accord 
            express des deux parties.
        </p>
    </div>

    <div class="section">
        <div class="section-title">TYPE DE MANDAT</div>
        
        <div class="field">
            @if(($data['type_mandat'] ?? 'simple') === 'exclusif')
                <span class="checkbox checked"></span> <strong>Mandat exclusif</strong> - Le mandant s'engage à ne confier sa recherche qu'au seul mandataire.
            @else
                <span class="checkbox checked"></span> <strong>Mandat simple</strong> - Le mandant peut confier sa recherche à plusieurs mandataires.
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">HONORAIRES</div>
        
        <p>
            En contrepartie de ses services, le mandataire percevra des honoraires selon les modalités suivantes :
        </p>
        
        <div class="highlight-box">
            @if(!empty($data['montant_honoraires']))
            <div class="field">
                <span class="field-label">Montant des honoraires :</span>
                <span class="field-value">{{ number_format($data['montant_honoraires'], 2, ',', ' ') }} € HT 
                ({{ number_format($data['montant_honoraires'] * 1.20, 2, ',', ' ') }} € TTC)</span>
            </div>
            @else
            <p>Les honoraires seront définis selon le barème en vigueur de ParFiPro, entre 1% HT et 6% HT du prix d'acquisition.</p>
            @endif
        </div>
        
        <p style="margin-top: 10px;">
            <strong>Modalités de paiement :</strong><br>
            Les honoraires sont dus uniquement en cas de réussite de la mission, c'est-à-dire lors de la signature 
            de l'acte authentique d'acquisition du bien.
        </p>
    </div>

    <div class="section">
        <div class="section-title">OBLIGATIONS DU MANDATAIRE</div>
        <p>Le mandataire s'engage à :</p>
        <ul>
            <li>Effectuer des recherches actives de biens correspondant aux critères du mandant</li>
            <li>Présenter au mandant les biens sélectionnés correspondant à sa demande</li>
            <li>Organiser les visites des biens présentés</li>
            <li>Informer régulièrement le mandant de l'avancement de ses recherches</li>
            <li>Accompagner le mandant dans les négociations avec les vendeurs ou leurs représentants</li>
            <li>Respecter la confidentialité des informations communiquées par le mandant</li>
        </ul>
    </div>

    <div class="section">
        <div class="section-title">OBLIGATIONS DU MANDANT</div>
        <p>Le mandant s'engage à :</p>
        <ul>
            <li>Fournir au mandataire toutes les informations nécessaires à l'accomplissement de sa mission</li>
            <li>Informer le mandataire de toute évolution de ses critères de recherche</li>
            <li>Informer le mandataire de toute offre d'achat qu'il formulerait sur un bien</li>
            <li>Se rendre disponible pour les visites organisées par le mandataire</li>
            <li>Régler les honoraires convenus en cas de réussite de la mission</li>
        </ul>
    </div>

    <div class="section">
        <div class="section-title">RÉSILIATION</div>
        <p>
            Le présent mandat peut être résilié à tout moment par l'une ou l'autre des parties, sous réserve 
            d'un préavis de 15 jours notifié par lettre recommandée avec accusé de réception.
        </p>
        <p>
            En cas de résiliation anticipée à l'initiative du mandant, aucun frais ne sera dû au mandataire, 
            sauf si une transaction est en cours de finalisation.
        </p>
    </div>

    @if(!empty($data['commentaires']))
    <div class="section">
        <div class="section-title">INFORMATIONS COMPLÉMENTAIRES</div>
        <div class="box">
            {{ $data['commentaires'] }}
        </div>
    </div>
    @endif

    <div class="section">
        <div class="section-title">PROTECTION DES DONNÉES PERSONNELLES</div>
        <p style="font-size: 8px;">
            En application du Règlement Général sur la Protection des Données (RGPD), le mandant est informé que 
            les données à caractère personnel le concernant sont collectées et traitées par ParFiPro dans le cadre 
            de l'exécution du présent mandat. Ces données sont conservées pour la durée nécessaire à l'accomplissement 
            de la mission et conformément aux obligations légales. Le mandant dispose d'un droit d'accès, de 
            rectification, d'effacement, de limitation du traitement et de portabilité de ses données. Il peut 
            exercer ces droits en contactant : Raphaël JACOB – rjacob.parfipro@gmail.com – 06-34-68-07-95.
        </p>
    </div>

    <div class="signature-area">
        <p><strong>Fait à {{ $data['fait_a'] }}, le {{ \Carbon\Carbon::parse($data['date_document'])->format('d/m/Y') }}</strong></p>
        <p style="margin-bottom: 20px;">En deux exemplaires dont un remis au mandant.</p>
        
        <table class="signatures">
            <tr>
                <td>
                    <strong>Le Mandant</strong><br>
                    @if(!empty($data['conjoint_nom']))
                    {{ $client->nom_complet ?? '' }}<br>
                    {{ $data['conjoint_prenom'] ?? '' }} {{ $data['conjoint_nom'] ?? '' }}<br>
                    @else
                    {{ $client->nom_complet ?? '' }}<br>
                    @endif
                    <br>
                    Signature précédée de "Lu et approuvé"<br><br><br><br>
                </td>
                <td>
                    <strong>Le Mandataire</strong><br>
                    ParFiPro<br>
                    Représentée par {{ $data['nom_conseiller'] ?? 'Raphaël JACOB' }}<br>
                    <br>
                    Signature précédée de "Lu et approuvé"<br><br><br><br>
                </td>
            </tr>
        </table>
    </div>

    <footer>
        <table style="text-align: center; width: 70%; margin-left: 15%;">
            <tr>
                <td style="width: 40%;">
                    <img src="{!! public_path('img/cncef.png') !!}" width="180" style="text-align:center"></img><br>
                </td>
                <td style="width: 60%;">
                    ParFiPro au capital de 1000 € - Siège social 173 Boulevard Pereire 75017 Paris<br>
                    SIREN – 880 874 466 RCS de Paris – ORIAS 200 01 570 – www.orias.fr<br>
                    Carte professionnelle CPI 7501 2025 000 000 230<br>
                    www.parfipro.com – Tel : 06-34-68-07-95 – rjacob.parfipro@gmail.com
                </td>
            </tr>
        </table>
    </footer>

</body>
</html>