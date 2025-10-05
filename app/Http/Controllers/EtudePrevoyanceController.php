<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EtudePrevoyanceController extends Controller
{
    public function generatePdf()
    {
        // Données de l'étude de prévoyance
        $data = [
            'title' => 'ETUDE PREVOYANCE TNS',
            'columns' => [
                'Option 1',
                'Option 2', 
                'Option 3'
            ],
            'incapacite_travail' => [
                'franchise_maladie' => ['15 jrs', '30 jrs', '15 jrs'],
                'franchise_accident' => ['15 jrs', '3 jrs', '15 jrs'],
                'franchise_hospitalisation' => ['15 jrs', '3 jrs', '3 jrs'],
                'montant_ij_4_90j' => ['268,85 € + RO', '127 € + RO', '268 € + RO'],
                'montant_ij_91_1095j' => ['268,85 € + RO', '141,5 € + RO', '268 € + RO'],
                'total_mensuel' => ['13 951,50 €', '10 077,90 €', '13 934 €'],
                'indemnisation' => ['Indemnitaire', 'Indemnitaire', 'Indemnitaire']
            ],
            'invalidite' => [
                'montant_rente' => ['7949,45€ + RO', '5850,95 € + RO', '10 000€ - RO'],
                'total_mensuel_rente' => ['10 452,45 €', '8 354 €', '10 000€ - RO'],
                'bareme' => ['', 'Barême Pro', 'Barême Pro'],
                'expertise_medicale' => ['', 'Expertise Médicale avec médecin indépendant sur seule incapacité Pro', ''],
                'seuil_declenchement' => ['33%', '16%', '16%'],
                'mode_calcul' => ['T/66', '3T/2', '3T/2'],
                'notion_revenus' => ['oui', 'non', 'non']
            ],
            'capital_deces' => [
                'montant' => ['191 500 €', '370 944 €', '250 000 €'],
                'rente_education_moins_12' => ['688 €', '1 159 €', '700 €'],
                'rente_education_12_17' => ['688 €', '1 546 €', '1 050 €'],
                'rente_education_18_25' => ['688 €', '1 932 €', '1 400 €'],
                'frais_obseques' => ['', '3 864 €', ''],
                'double_effet' => ['', '139 104 €', '250 000 €']
            ],
            'exclusions' => [
                'dos' => ['Couvert sous conditions', 'Couvert sous conditions', 'Couvert sous conditions'],
                'psy' => ['Couvert sous conditions', 'Couvert sous conditions', 'Couvert sous conditions']
            ],
            'options' => [
                'exoneration_cotisation' => ['OUI', 'OUI', 'OUI'],
                'capital_deces_accident' => ['', '162 288 €', '250 000 €']
            ],
            'tarif_mensuel' => ['246,80 €', '146,80 €', '182,00 €'],
            'footer_info' => [
                'presenter' => 'Cette étude comparative vous est présentée par le Cabinet ParFIPro avec le concours de M JACOB, Expert indépendant en protection sociale - 06 34 68 07 95',
                'legal' => 'Société de courtage en assurance de personne - Code Naf : 66.19B- RCS Paris : 880874466 – Garantie financière et responsabilité civile conformes aux articles L 530.1 et L 530.2 du code des assurances – Immatriculée à l\'ORIAS sous le N° 20001570 ( www.orias.fr ) – sous le contrôle de l\'ACPR, 61 rue Taitbout 75009 Paris ( acpr.banque-france.fr )',
                'website' => 'www.parfipro.com'
            ]
        ];

        // Générer le PDF
        $pdf = Pdf::loadView('pdf.etude-prevoyance', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('etude-prevoyance-tns.pdf');
    }

    public function showPreview()
    {
        // Même données que pour le PDF
        $data = [
            'title' => 'ETUDE PREVOYANCE TNS',
            'columns' => [
                'Option 1',
                'Option 2', 
                'Option 3'
            ],
            'incapacite_travail' => [
                'franchise_maladie' => ['15 jrs', '30 jrs', '15 jrs'],
                'franchise_accident' => ['15 jrs', '3 jrs', '15 jrs'],
                'franchise_hospitalisation' => ['15 jrs', '3 jrs', '3 jrs'],
                'montant_ij_4_90j' => ['268,85 € + RO', '127 € + RO', '268 € + RO'],
                'montant_ij_91_1095j' => ['268,85 € + RO', '141,5 € + RO', '268 € + RO'],
                'total_mensuel' => ['13 951,50 €', '10 077,90 €', '13 934 €'],
                'indemnisation' => ['Indemnitaire', 'Indemnitaire', 'Indemnitaire']
            ],
            'invalidite' => [
                'montant_rente' => ['7949,45€ + RO', '5850,95 € + RO', '10 000€ - RO'],
                'total_mensuel_rente' => ['10 452,45 €', '8 354 €', '10 000€ - RO'],
                'bareme' => ['', 'Barême Pro', 'Barême Pro'],
                'expertise_medicale' => ['', 'Expertise Médicale avec médecin indépendant sur seule incapacité Pro', ''],
                'seuil_declenchement' => ['33%', '16%', '16%'],
                'mode_calcul' => ['T/66', '3T/2', '3T/2'],
                'notion_revenus' => ['oui', 'non', 'non']
            ],
            'capital_deces' => [
                'montant' => ['191 500 €', '370 944 €', '250 000 €'],
                'rente_education_moins_12' => ['688 €', '1 159 €', '700 €'],
                'rente_education_12_17' => ['688 €', '1 546 €', '1 050 €'],
                'rente_education_18_25' => ['688 €', '1 932 €', '1 400 €'],
                'frais_obseques' => ['', '3 864 €', ''],
                'double_effet' => ['', '139 104 €', '250 000 €']
            ],
            'exclusions' => [
                'dos' => ['Couvert sous conditions', 'Couvert sous conditions', 'Couvert sous conditions'],
                'psy' => ['Couvert sous conditions', 'Couvert sous conditions', 'Couvert sous conditions']
            ],
            'options' => [
                'exoneration_cotisation' => ['OUI', 'OUI', 'OUI'],
                'capital_deces_accident' => ['', '162 288 €', '250 000 €']
            ],
            'tarif_mensuel' => ['246,80 €', '146,80 €', '182,00 €'],
            'footer_info' => [
                'presenter' => 'Cette étude comparative vous est présentée par le Cabinet ParFIPro avec le concours de M JACOB, Expert indépendant en protection sociale - 06 34 68 07 95',
                'legal' => 'Société de courtage en assurance de personne - Code Naf : 66.19B- RCS Paris : 880874466 – Garantie financière et responsabilité civile conformes aux articles L 530.1 et L 530.2 du code des assurances – Immatriculée à l\'ORIAS sous le N° 20001570 ( www.orias.fr ) – sous le contrôle de l\'ACPR, 61 rue Taitbout 75009 Paris ( acpr.banque-france.fr )',
                'website' => 'www.parfipro.com'
            ]
        ];

        return view('pdf.etude-prevoyance', $data);
    }
}