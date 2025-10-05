<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
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
            padding: 4px 6px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        .section-header {
            background-color: #e6e6e6;
            font-weight: bold;
            text-align: left;
            padding: 6px;
        }
        
        .row-label {
            background-color: #f8f8f8;
            font-weight: bold;
            width: 30%;
        }
        
        .amount-cell {
            text-align: right;
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
        
        .footer {
            margin-top: 30px;
            font-size: 8px;
            line-height: 1.3;
            color: #666;
        }
        
        .footer-presenter {
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .footer-legal {
            margin-bottom: 5px;
        }
        
        .footer-website {
            text-align: center;
            font-weight: bold;
            color: #2c5aa0;
        }
        
        .small-text {
            font-size: 8px;
        }
        
        .highlight {
            background-color: #ffffcc;
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
                    <th style="width: 30%;"></th>
                    @foreach($columns as $column)
                        <th style="width: 23.33%;">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- Incapacité de travail -->
                <tr>
                    <td class="section-header" colspan="4">Incapacité de travail</td>
                </tr>
                <tr>
                    <td class="row-label">Franchise Maladie</td>
                    @foreach($incapacite_travail['franchise_maladie'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Franchise Accident</td>
                    @foreach($incapacite_travail['franchise_accident'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Franchise Hospitalisation</td>
                    @foreach($incapacite_travail['franchise_hospitalisation'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Montant IJ 4 à 90J</td>
                    @foreach($incapacite_travail['montant_ij_4_90j'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Montant IJ 91 au 1095 J</td>
                    @foreach($incapacite_travail['montant_ij_91_1095j'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Total mensuel indemnités</td>
                    @foreach($incapacite_travail['total_mensuel'] as $value)
                        <td class="amount-cell highlight">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Indemnisation</td>
                    @foreach($incapacite_travail['indemnisation'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Invalidité -->
                <tr>
                    <td class="section-header" colspan="4">Invalidité</td>
                </tr>
                <tr>
                    <td class="row-label">Montant de la rente / mois</td>
                    @foreach($invalidite['montant_rente'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Total mensuel rente</td>
                    @foreach($invalidite['total_mensuel_rente'] as $value)
                        <td class="amount-cell highlight">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Barème</td>
                    @foreach($invalidite['bareme'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label small-text">Expertise Médicale</td>
                    @foreach($invalidite['expertise_medicale'] as $key => $value)
                        <td class="small-text centered">
                            @if($key == 1)
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Seuil de Déclenchement</td>
                    @foreach($invalidite['seuil_declenchement'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Mode de calcul indemnisation</td>
                    @foreach($invalidite['mode_calcul'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Notion de revenus</td>
                    @foreach($invalidite['notion_revenus'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Capital Décès / PTIA -->
                <tr>
                    <td class="section-header" colspan="4">Capital Décès / PTIA</td>
                </tr>
                <tr>
                    <td class="row-label">Montant</td>
                    @foreach($capital_deces['montant'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Rente éducation par enfant /mois</td>
                    <td colspan="3" class="section-header small-text"></td>
                </tr>
                <tr>
                    <td class="row-label">moins de 12 ans</td>
                    @foreach($capital_deces['rente_education_moins_12'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">entre 12 et 17 ans</td>
                    @foreach($capital_deces['rente_education_12_17'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">entre 18 et 25 ans</td>
                    @foreach($capital_deces['rente_education_18_25'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Frais obsèques</td>
                    @foreach($capital_deces['frais_obseques'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Double effet</td>
                    @foreach($capital_deces['double_effet'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Exclusions -->
                <tr>
                    <td class="section-header" colspan="4">Exclusions</td>
                </tr>
                <tr>
                    <td class="row-label">Dos</td>
                    @foreach($exclusions['dos'] as $value)
                        <td class="small-text centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Psy</td>
                    @foreach($exclusions['psy'] as $value)
                        <td class="small-text centered">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Options -->
                <tr>
                    <td class="section-header" colspan="4">Options</td>
                </tr>
                <tr>
                    <td class="row-label">Exonération de cotisation</td>
                    @foreach($options['exoneration_cotisation'] as $value)
                        <td class="centered">{{ $value }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="row-label">Capital décès accident</td>
                    @foreach($options['capital_deces_accident'] as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
                
                <!-- Tarif Mensuel -->
                <tr class="tarif-row">
                    <td class="row-label">Tarif Mensuel</td>
                    @foreach($tarif_mensuel as $value)
                        <td class="amount-cell">{{ $value }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <div class="footer-presenter">
            {{ $footer_info['presenter'] }}
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