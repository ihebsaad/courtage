<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 25px;
            color: #2c5aa0;
        }
        
        .table-container {
            width: 100%;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        
        th, td {
            border: 1px solid #333;
            padding: 5px 8px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 12px;
        }
        
        .section-header {
            background-color: #e6e6e6;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }
        
        .row-label {
            background-color: #f8f8f8;
            font-weight: normal;
            width: 60%;
            font-size: 10px;
        }
        
        .value-cell {
            text-align: center;
            font-weight: bold;
            width: 20%;
        }
        
        .amount-cell {
            text-align: center;
            font-weight: bold;
        }
        
        .centered {
            text-align: center;
        }
        
        .tarif-row {
            background-color: #fff2cc;
            font-weight: bold;
            font-size: 12px;
        }
        
        .gain-row {
            background-color: #ffe6e6;
            font-weight: bold;
            font-size: 12px;
        }
        
        .footer {
            margin-top: 30px;
            font-size: 8px;
            line-height: 1.4;
            color: #666;
        }
        
        .footer-note {
            margin-bottom: 10px;
            font-style: italic;
            color: #888;
        }
        
        .footer-expert {
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .footer-legal {
            margin-bottom: 5px;
            text-align: justify;
        }
        
        .footer-website {
            text-align: center;
            font-weight: bold;
            color: #2c5aa0;
            margin-top: 10px;
        }
        
        .small-text {
            font-size: 9px;
        }
        
        .highlight {
            background-color: #ffffcc;
        }
        
        .negative {
            color: #d32f2f;
        }
        
        .percentage {
            font-weight: bold;
            color: #1976d2;
        }
        
        .zero-amount {
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        {{ $title }}
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 60%;"></th>
                    @foreach($columns as $column)
                        <th style="width: 20%;">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- Hospitalisation -->
                <tr>
                    <td class="section-header" colspan="3">Hospitalisation</td>
                </tr>
                <tr>
                    <td class="row-label">Honoraires Chirurgicaux OPTAM</td>
                    @foreach($hospitalisation['honoraires_chirurgicaux_optam'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Honoraires Chirurgicaux NON OPTAM</td>
                    @foreach($hospitalisation['honoraires_chirurgicaux_non_optam'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Imagerie médicale OPTAM / NON OPTAM</td>
                    @foreach($hospitalisation['imagerie_medicale_optam_non_optam'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Chambre particulière par jour</td>
                    @foreach($hospitalisation['chambre_particuliere'] as $value)
                        <td class="value-cell amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Soins Courants -->
                <tr>
                    <td class="section-header" colspan="3">Soins Courants</td>
                </tr>
                <tr>
                    <td class="row-label">Consultations Généralistes OPTAM</td>
                    @foreach($soins_courants['consultations_generalistes_optam'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Consultations Spécialistes OPTAM</td>
                    @foreach($soins_courants['consultations_specialistes_optam'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Consultations Généraliste / Spécialistes NON OPTAM</td>
                    @foreach($soins_courants['consultations_non_optam'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Analyse & examens de laboratoire</td>
                    @foreach($soins_courants['analyse_examens'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Honoraires Paramédicaux</td>
                    @foreach($soins_courants['honoraires_paramedicaux'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Pharmacie : Médicaments remboursables : 15/30/65</td>
                    @foreach($soins_courants['pharmacie_remboursables'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Pharmacie: non Remboursé - Autres vaccins</td>
                    @foreach($soins_courants['pharmacie_non_rembourse'] as $value)
                        <td class="value-cell amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Dentaire -->
                <tr>
                    <td class="section-header" colspan="3">Dentaire</td>
                </tr>
                <tr>
                    <td class="row-label">Soins Dentaires remboursé par le RO</td>
                    @foreach($dentaire['soins_dentaires_ro'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Inlays-Onlays remboursé par le RO</td>
                    @foreach($dentaire['inlays_onlays_ro'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Prothèse dentaire sur dents visibles remboursé par le RO</td>
                    @foreach($dentaire['prothese_dentaire_ro'] as $value)
                        <td class="value-cell percentage">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Implantologie non remboursé</td>
                    @foreach($dentaire['implantologie_non_rembourse'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Orthodontie non remboursée par semestre</td>
                    @foreach($dentaire['orthodontie_non_remboursee'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Optique -->
                <tr>
                    <td class="section-header" colspan="3">Optique</td>
                </tr>
                <tr>
                    <td class="row-label">Forfait pour monture</td>
                    @foreach($optique['forfait_monture'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Forfait pour verres simples</td>
                    @foreach($optique['forfait_verres_simples'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Forfait pour verres complexes</td>
                    @foreach($optique['forfait_verres_complexes'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Forfait pour verres très complexes</td>
                    @foreach($optique['forfait_verres_tres_complexes'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Lentilles acceptés</td>
                    @foreach($optique['lentilles_acceptees'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Lentilles refusées</td>
                    @foreach($optique['lentilles_refusees'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Traitement Laser Oculaire non remboursé par le RO</td>
                    @foreach($optique['traitement_laser'] as $value)
                        <td class="value-cell amount-cell @if($value == '0 €') zero-amount @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Médecine Douce -->
                <tr>
                    <td class="section-header" colspan="3">Médecine Douce</td>
                </tr>
                <tr>
                    <td class="row-label"></td>
                    @foreach($medecine_douce as $value)
                        <td class="value-cell amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Options -->
                <tr>
                    <td class="section-header" colspan="3">Options</td>
                </tr>
                
                <!-- Tarif Mensuel -->
                <tr class="tarif-row">
                    <td class="row-label">Tarif Mensuel</td>
                    @foreach($tarif_mensuel as $value)
                        <td class="value-cell amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Gain annuel estimé -->
                <tr class="gain-row">
                    <td class="row-label">Gain annuel estimé</td>
                    @foreach($gain_annuel as $value)
                        <td class="value-cell amount-cell @if(str_contains($value, '-')) negative @endif">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Frais de dossier -->
                <tr>
                    <td class="row-label">Frais de dossier</td>
                    @foreach($frais_dossier as $value)
                        <td class="value-cell centered">{{ $value }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <div class="footer-note">
            {{ $footer_info['note'] }}
        </div>
        <div class="footer-expert">
            {{ $footer_info['expert'] }}
        </div>
        <div class="footer-legal">
            {{ $footer_info['legal'] }}
        </div>
        <div class="footer-website">
            {{ $footer_info['website'] }}
        </div>
    </div>
</body>
</html>