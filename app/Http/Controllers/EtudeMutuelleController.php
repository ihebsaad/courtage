<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EtudeMutuelleController extends Controller
{
    public function generatePdf()
    {
        // Données de l'étude mutuelle
        $data = [
            'title' => 'ETUDE MUTUELLE TNS',
            'columns' => [
                'Option 1',
                'Option 2'
            ],
            'hospitalisation' => [
                'honoraires_chirurgicaux_optam' => ['400%', '150%'],
                'honoraires_chirurgicaux_non_optam' => ['200%', '130%'],
                'imagerie_medicale_optam_non_optam' => ['100 % / 100 %', '130 % / 110 %'],
                'chambre_particuliere' => ['40 €', '40 €']
            ],
            'soins_courants' => [
                'consultations_generalistes_optam' => ['100%', '130%'],
                'consultations_specialistes_optam' => ['100%', '130%'],
                'consultations_non_optam' => ['100%', '110%'],
                'analyse_examens' => ['100%', '130%'],
                'honoraires_paramedicaux' => ['100%', '130%'],
                'pharmacie_remboursables' => ['100%', '100%'],
                'pharmacie_non_rembourse' => ['50 €', '30 €']
            ],
            'dentaire' => [
                'soins_dentaires_ro' => ['100%', '130%'],
                'inlays_onlays_ro' => ['100%', '130%'],
                'prothese_dentaire_ro' => ['100%', '130%'],
                'implantologie_non_rembourse' => ['0 €', '150 €'],
                'orthodontie_non_remboursee' => ['0 €', '150 €']
            ],
            'optique' => [
                'forfait_monture' => ['0 €', '100 €'],
                'forfait_verres_simples' => ['0 €', '100 €'],
                'forfait_verres_complexes' => ['0 €', '200 €'],
                'forfait_verres_tres_complexes' => ['0 €', '200 €'],
                'lentilles_acceptees' => ['0 €', '75 €'],
                'lentilles_refusees' => ['0 €', '75 €'],
                'traitement_laser' => ['0 €', '100 €']
            ],
            'medecine_douce' => ['0 € / an', '50 € / an'],
            'tarif_mensuel' => ['52,96 €', '75,61 €'],
            'gain_annuel' => ['-271,80 €', ''],
            'frais_dossier' => ['NC', 'NC'],
            'footer_info' => [
                'note' => 'Médecine Douce : ostéopathie, psychologue ….',
                'expert' => 'Cette étude à été réalisée par M Raphaël JACOB - Expert Indépendant en Protection Sociale - 06.34.68.07.95',
                'legal' => 'Société de courtage en assurance - Code Naf : 76619B RCS Paris: 880874466 – Garantie financière et responsabilité civile conformes aux articles L 530.1 et L 530.2 du code des assurances – Immatriculée à l\'ORIAS sous le N° 20001570 www.orias.fr ) – sous le contrôle de l\'ACPR, 61 rue Taitbout 75009 Paris ( acpr.banque-france.fr )',
                'website' => 'www.parfipro.com'
            ]
        ];

        // Générer le PDF
        $pdf = Pdf::loadView('pdf.etude-mutuelle', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('etude-mutuelle-tns.pdf');
    }

    public function showPreview()
    {
        // Même données que pour le PDF
        $data = [
            'title' => 'ETUDE MUTUELLE TNS',
            'columns' => [
                'Option 1',
                'Option 2'
            ],
            'hospitalisation' => [
                'honoraires_chirurgicaux_optam' => ['400%', '150%'],
                'honoraires_chirurgicaux_non_optam' => ['200%', '130%'],
                'imagerie_medicale_optam_non_optam' => ['100 % / 100 %', '130 % / 110 %'],
                'chambre_particuliere' => ['40 €', '40 €']
            ],
            'soins_courants' => [
                'consultations_generalistes_optam' => ['100%', '130%'],
                'consultations_specialistes_optam' => ['100%', '130%'],
                'consultations_non_optam' => ['100%', '110%'],
                'analyse_examens' => ['100%', '130%'],
                'honoraires_paramedicaux' => ['100%', '130%'],
                'pharmacie_remboursables' => ['100%', '100%'],
                'pharmacie_non_rembourse' => ['50 €', '30 €']
            ],
            'dentaire' => [
                'soins_dentaires_ro' => ['100%', '130%'],
                'inlays_onlays_ro' => ['100%', '130%'],
                'prothese_dentaire_ro' => ['100%', '130%'],
                'implantologie_non_rembourse' => ['0 €', '150 €'],
                'orthodontie_non_remboursee' => ['0 €', '150 €']
            ],
            'optique' => [
                'forfait_monture' => ['0 €', '100 €'],
                'forfait_verres_simples' => ['0 €', '100 €'],
                'forfait_verres_complexes' => ['0 €', '200 €'],
                'forfait_verres_tres_complexes' => ['0 €', '200 €'],
                'lentilles_acceptees' => ['0 €', '75 €'],
                'lentilles_refusees' => ['0 €', '75 €'],
                'traitement_laser' => ['0 €', '100 €']
            ],
            'medecine_douce' => ['0 € / an', '50 € / an'],
            'tarif_mensuel' => ['52,96 €', '75,61 €'],
            'gain_annuel' => ['-271,80 €', ''],
            'frais_dossier' => ['NC', 'NC'],
            'footer_info' => [
                'note' => 'Médecine Douce : ostéopathie, psychologue ….',
                'expert' => 'Cette étude à été réalisée par M Raphaël JACOB - Expert Indépendant en Protection Sociale - 06.34.68.07.95',
                'legal' => 'Société de courtage en assurance - Code Naf : 76619B RCS Paris: 880874466 – Garantie financière et responsabilité civile conformes aux articles L 530.1 et L 530.2 du code des assurances – Immatriculée à l\'ORIAS sous le N° 20001570 www.orias.fr ) – sous le contrôle de l\'ACPR, 61 rue Taitbout 75009 Paris ( acpr.banque-france.fr )',
                'website' => 'www.parfipro.com'
            ]
        ];

        return view('pdf.etude-mutuelle', $data);
    }
}