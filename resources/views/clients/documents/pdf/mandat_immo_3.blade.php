<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiche de Connaissance Client⸱es</title>
    <style>
        @page { margin: 80px 50px 100px 50px; size: A4; }
        body { font-family: Arial, sans-serif; font-size: 8px; line-height: 1.2; }
        .header-box { padding: 8px; margin-bottom: 10px; text-align: center; margin-top: -80px; }
        .title { font-size: 16px; font-weight: bold; text-align: center; margin: 10px 0; }
        .date-rdv { text-align: left; margin: 10px 0; font-size: 9px; }
        .section { margin-bottom: 8px; page-break-inside: avoid; }
        .section-title { font-weight: bold; background-color: #000; color: #fff; padding: 4px; margin-bottom: 5px; font-size: 9px; }
        .subsection-title { font-weight: bold; margin-top: 8px; margin-bottom: 4px; font-size: 8px; }
        footer { position: fixed; bottom: -80px; left: 0; right: 0; text-align: center; font-size: 7px; line-height: 1.3; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
        table td, table th { border: 1px solid #000; padding: 3px; font-size: 7px; }
        table th { background-color: #f0f0f0; font-weight: bold; }
        .field-value { background-color: #000; color: #fff; padding: 2px 4px; display: inline-block; min-width: 80px; }
        .row-flex { display: flex; justify-content: space-between; margin-bottom: 3px; }
        .col-half { width: 48%; }
        .checkbox { display: inline-block; width: 10px; height: 10px; border: 1px solid #000; margin-right: 3px; vertical-align: middle; }
        .checkbox.checked::before { content: '✓'; font-weight: bold; font-size: 9px; }
        .objective-row { margin-bottom: 2px; font-size: 7px; }
    </style>
</head>
<body>
    <script type="text/php">
    if (isset($pdf)) {
     //Shows number center-bottom of A4 page with $x,$y values
        $x = 520;  //X-axis i.e. vertical position
        $y = 820; //Y-axis horizontal position
        $text = "Page {PAGE_NUM} / {PAGE_COUNT}";  //format of display message
        $font =  $fontMetrics->get_font("helvetica", "bold");
        $size = 8;
        $color = array(0,0,0);
        $color2 = array(136,136,136);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        //$pdf->page_text(30, $y,' ' , $font, $size, $color, $word_space, $char_space, $angle);
    }
    </script>
    <div class="header-box">
        <img src="{{ asset('img/logo.png')}}" width="60" />
    </div>

    <div class="title">FICHE DE CONNAISSANCE CLIENT⸱ES</div>
    <div class="date-rdv">Date du RDV : {{ \Carbon\Carbon::parse($data['date_rdv'])->format('d/m/Y') }}</div>

    <div class="section">
        <div class="section-title">Votre projet</div>
        <table>
            <tr>
                <td style="width: 25%;"><strong>Nature du projet</strong></td>
                <td style="width: 25%;" class="field-value">{{ $data['nature_projet'] ?? '' }}</td>
                <td style="width: 25%;"><strong>Destination du logement</strong></td>
                <td style="width: 25%;" class="field-value">{{ $data['destination_logement'] ?? '' }}</td>
            </tr>
        </table>

        <div class="subsection-title">Coût du projet estimatif</div>
        <table>
            <tr>
                <th style="width: 50%;">Dépenses</th>
                <th style="width: 50%;">Ressources</th>
            </tr>
            <tr>
                <td>
                    Prix d'acquisition / CRD : <span class="field-value">{{ number_format($data['prix_acquisition'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Frais de notaire : <span class="field-value">{{ number_format($data['frais_notaire'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Frais d'agence : <span class="field-value">{{ number_format($data['frais_agence'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Travaux : <span class="field-value">{{ number_format($data['travaux'] ?? 0, 0, ',', ' ') }} €</span><br>
                    IRA : <span class="field-value">{{ number_format($data['ira'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Estimation frais de garantie : <span class="field-value">{{ number_format($data['frais_garantie'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Estimation frais de banque : <span class="field-value">{{ number_format($data['frais_banque'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Honoraires de courtage : <span class="field-value">{{ number_format($data['honoraires_courtage'] ?? 0, 0, ',', ' ') }} €</span>
                </td>
                <td>
                    Apport personnel : <span class="field-value">{{ number_format($data['apport_personnel'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Dont épargne : <span class="field-value">{{ number_format($data['dont_epargne'] ?? 0, 0, ',', ' ') }} €</span><br>
                    Dont donation : <span class="field-value">{{ number_format($data['dont_donation'] ?? 0, 0, ',', ' ') }} €</span>
                </td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>Total</strong></td>
            </tr>
        </table>

        <div class="subsection-title">Échéance</div>
        <table>
            <tr>
                <td style="width: 25%;"><strong>Date estimée signature</strong></td>
                <td style="width: 25%;" class="field-value">{{ $data['date_signature'] ? \Carbon\Carbon::parse($data['date_signature'])->format('d/m/Y') : '' }}</td>
                <td style="width: 25%;"><strong>Priorité</strong></td>
                <td style="width: 25%;" class="field-value">{{ $data['priorite'] ?? '' }}</td>
            </tr>
        </table>

        @if($data['projet_societe'] ?? '')
        <div class="subsection-title">Projet via une société</div>
        <p style="font-size: 7px; margin: 3px 0;">{{ $data['projet_societe'] }}</p>
        @endif
    </div>

    <div class="section">
        <div class="section-title">Vos objectifs</div>
        <table>
            <tr>
                <th style="width: 50%;">Objectifs</th>
                <th style="width: 50%;">Commentaires</th>
            </tr>
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
            <tr>
                <td>
                    <span class="checkbox {{ !empty($data["objectif_$key"]) ? 'checked' : '' }}"></span> {{ $label }}
                </td>
                <td class="field-value">{{ $data["objectif_{$key}_commentaire"] ?? '' }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <div class="section-title">Vos informations personnelles</div>
        <table>
            <tr>
                <th style="width: 50%;">Client 1</th>
                <th style="width: 50%;">Client 2</th>
            </tr>
            <tr>
                <td>
                    <strong>Prénom / Nom :</strong> <span class="field-value">{{ $data['client1_nom'] ?? '' }}</span><br>
                    <strong>Nom patronymique :</strong> <span class="field-value">{{ $data['client1_nom_patronymique'] ?? '' }}</span><br>
                    <strong>Situation familiale :</strong> <span class="field-value">{{ $data['client1_situation'] ?? '' }}</span><br>
                    <strong>Régime matrimonial :</strong> <span class="field-value">{{ $data['client1_regime'] ?? '' }}</span><br>
                    <strong>Date de naissance :</strong> <span class="field-value">{{ $data['client1_date_naissance'] ? \Carbon\Carbon::parse($data['client1_date_naissance'])->format('d/m/Y') : '' }}</span><br>
                    <strong>Lieu de naissance :</strong> <span class="field-value">{{ $data['client1_lieu_naissance'] ?? '' }}</span><br>
                    <strong>Nationalité :</strong> <span class="field-value">{{ $data['client1_nationalite'] ?? '' }}</span><br>
                    <strong>Nb d'enfants à charge :</strong> <span class="field-value">{{ $data['client1_nb_enfants'] ?? '' }}</span><br>
                    <strong>Adresse :</strong> <span class="field-value">{{ $data['client1_adresse'] ?? '' }}</span>
                </td>
                <td>
                    <strong>Prénom / Nom :</strong> <span class="field-value">{{ $data['client2_nom'] ?? '' }}</span><br>
                    <strong>Nom patronymique :</strong> <span class="field-value">{{ $data['client2_nom_patronymique'] ?? '' }}</span><br>
                    <strong>Situation familiale :</strong> <span class="field-value">{{ $data['client2_situation'] ?? '' }}</span><br>
                    <strong>Régime matrimonial :</strong> <span class="field-value">{{ $data['client2_regime'] ?? '' }}</span><br>
                    <strong>Date de naissance :</strong> <span class="field-value">{{ $data['client2_date_naissance'] ? \Carbon\Carbon::parse($data['client2_date_naissance'])->format('d/m/Y') : '' }}</span><br>
                    <strong>Lieu de naissance :</strong> <span class="field-value">{{ $data['client2_lieu_naissance'] ?? '' }}</span><br>
                    <strong>Nationalité :</strong> <span class="field-value">{{ $data['client2_nationalite'] ?? '' }}</span><br>
                    <strong>Nb d'enfants à charge :</strong> <span class="field-value">{{ $data['client2_nb_enfants'] ?? '' }}</span><br>
                    <strong>Adresse :</strong> <span class="field-value">{{ $data['client2_adresse'] ?? '' }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Date du mariage / PACS :</strong> <span class="field-value">{{ $data['date_mariage'] ? \Carbon\Carbon::parse($data['date_mariage'])->format('d/m/Y') : '' }}</span> 
                    <strong>Date du divorce :</strong> <span class="field-value">{{ $data['date_divorce'] ? \Carbon\Carbon::parse($data['date_divorce'])->format('d/m/Y') : 'NC' }}</span>
                    <strong>Pension alimentaire :</strong> <span class="field-value">{{ $data['pension_type'] ?? '' }} {{ $data['pension_montant'] ? number_format($data['pension_montant'], 0, ',', ' ') . ' €' : '' }}</span>
                </td>
            </tr>
        </table>

        <div class="subsection-title">Logement actuel</div>
        <table>
            <tr>
                <td style="width: 50%;">
                    <strong>Client 1</strong><br>
                    Statut : <span class="field-value">{{ $data['client1_logement_statut'] ?? '' }}</span><br>
                    Type : <span class="field-value">{{ $data['client1_type_logement'] ?? '' }}</span><br>
                    Montant loyer : <span class="field-value">{{ $data['client1_loyer'] ? number_format($data['client1_loyer'], 0, ',', ' ') . ' €' : '' }}</span><br>
                    Depuis : <span class="field-value">{{ $data['client1_depuis'] ? \Carbon\Carbon::parse($data['client1_depuis'])->format('d/m/Y') : '' }}</span>
                </td>
                <td style="width: 50%;">
                    <strong>Client 2</strong><br>
                    Statut : <span class="field-value">{{ $data['client2_logement_statut'] ?? '' }}</span><br>
                    Type : <span class="field-value">{{ $data['client2_type_logement'] ?? '' }}</span><br>
                    Montant loyer : <span class="field-value">{{ $data['client2_loyer'] ? number_format($data['client2_loyer'], 0, ',', ' ') . ' €' : '' }}</span>
                </td>
            </tr>
        </table>

        <div class="subsection-title">Enfants</div>
        <table>
            <tr>
                <td style="width: 50%;">
                    <strong>Client 1</strong><br>
                    @for($i = 1; $i <= 3; $i++)
                        @if($data["client1_enfant{$i}_nom"] ?? '')
                        {{ $data["client1_enfant{$i}_nom"] }} - {{ $data["client1_enfant{$i}_date"] ? \Carbon\Carbon::parse($data["client1_enfant{$i}_date"])->format('d/m/Y') : '' }}<br>
                        @endif
                    @endfor
                </td>
                <td style="width: 50%;">
                    <strong>Client 2</strong><br>
                    @for($i = 1; $i <= 3; $i++)
                        @if($data["client2_enfant{$i}_nom"] ?? '')
                        {{ $data["client2_enfant{$i}_nom"] }} - {{ $data["client2_enfant{$i}_date"] ? \Carbon\Carbon::parse($data["client2_enfant{$i}_date"])->format('d/m/Y') : '' }}<br>
                        @endif
                    @endfor
                </td>
            </tr>
        </table>

        @if($data['commentaire_client1'] ?? '' || $data['commentaire_client2'] ?? '')
        <div class="subsection-title">Commentaires informations personnelles</div>
        <table>
            <tr>
                <td style="width: 50%;">{{ $data['commentaire_client1'] ?? '' }}</td>
                <td style="width: 50%;">{{ $data['commentaire_client2'] ?? '' }}</td>
            </tr>
        </table>
        @endif
    </div>

    <footer>
        <table style="text-align: center; width: 70%; margin-left: 15%;">
            <tr>
                <td style="width: 40%;">
                    <img src="{{ public_path('img/cncef.png') }}" width="180" style="text-align:center">
                </td>
                <td style="width: 60%;">
                    ParFiPro au capital de 1000 € - Siège social 173 Boulevard Pereire 75017 Paris<br>
                    SIREN – 880 874 466 RCS de Paris – ORIAS 200 01 570 – www.orias.fr<br>
                    Sous le contrôle de l'ACPR – 4 place de Budapest CS 92459 75346 Paris cedex 9<br>
                    www.parfipro.com – Tel : 06-34-68-07-95 – rjacob.parfipro@gmail.com
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>