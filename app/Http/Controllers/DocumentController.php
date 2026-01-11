<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocumentData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    private $templates = [
        'mutuelle_individuelle_1' => 'Document DOCUMENT D\'ENTREE EN RELATION',
        'mutuelle_individuelle_2' => 'Document de Recueil des Exigences - Prévoyance',
        'mutuelle_individuelle_3' => 'FICHE CONSEIL',
        'mandat_immo_1' => 'Document d’entrée en relation - Mandat Immobilier',
        'mandat_immo_2' => '',
        'mandat_immo_3' => '',
        'mandat_financement_1' => '',
        'mandat_financement_2' => '',
        'mandat_financement_3' => '',
        'prevoyance_collective_1' => '',
        'prevoyance_collective_2' => '',
        'prevoyance_collective_3' => '',
        'mutuelle_collective_1' => '',
        'mutuelle_collective_2' => '',
        'mutuelle_collective_3' => '',
        'prevoyance_individuelle_1' => '',
        'prevoyance_individuelle_2' => '',
        'prevoyance_individuelle_3' => '',
    ];

    public function index(Client $client)
    {
        return view('clients.documents.index', [
            'client' => $client,
            'templates' => $this->templates
        ]);
    }

    public function create(Client $client, string $template)
    {
        if (!isset($this->templates[$template])) {
            abort(404);
        }

        // Préparer les données par défaut depuis le client
        $defaultData = $this->prepareDefaultData($client, $template);
        
        // Récupérer les données sauvegardées
        $savedData = $client->getDocumentData($template);
        
        // Fusionner : les données sauvegardées écrasent les valeurs par défaut
        $data = array_merge($defaultData, $savedData);
        
        return view("clients.documents.templates.{$template}", [
            'client' => $client,
            'data' => $data,
            'templateName' => $this->templates[$template],
            'hasSavedData' => !empty($savedData)
        ]);
    }

    public function generate(Request $request, Client $client, string $template)
    {
        if (!isset($this->templates[$template])) {
            abort(404);
        }

        // Récupérer TOUTES les données du formulaire
        $data = $request->except(['_token', '_method']);
        
        // Sauvegarder les données pour ce client et ce template
        ClientDocumentData::updateOrCreate(
            [
                'client_id' => $client->id,
                'template_key' => $template,
            ],
            [
                'data' => $data,
            ]
        );
        
        $pdf = Pdf::loadView("clients.documents.pdf.{$template}", [
            'client' => $client,
            'data' => $data
        ]);

        $filename = "{$template}_{$client->id}_" . now()->format('Y-m-d') . ".pdf";
        
        return $pdf->download($filename);
    }

    private function prepareDefaultData(Client $client, string $template)
    {
        // Données de base du client (toujours les mêmes)
        $baseData = [
            'civilite' => $client->civilite ?? '',
            'nom_usage' => $client->nom ?? '',
            'nom_naissance' => $client->nom ?? '',
            'prenoms' => $client->prenom ?? '',
            'date_naissance' => $client->date_naissance?->format('d/m/Y') ?? '',
            'situation_familiale' => $client->situation_familiale ?? '',
            'adresse' => $client->adresse_complete ?? '',
            'email' => $client->email ?? '',
            'telephone_mobile' => $client->telephone_portable ?? '',
            'profession' => $client->profession ?? '',
            'nom_complet' => $client->nom_complet ?? '',
        ];

        // Données spécifiques par template (valeurs par défaut vides)
        $templateDefaults = $this->getTemplateDefaults($template);
        
        return array_merge($baseData, $templateDefaults);
    }

    private function getTemplateDefaults(string $template)
    {
       
        // Définir les champs par défaut selon le template
        $defaults = [
            'mutuelle_individuelle_1' => [
                'date_entree_relation' => now()->format('Y-m-d'),
                'type_remuneration' => 'commission',
            ],
            'mutuelle_individuelle_2' => [
                'ppe' => '',
                'fonction_exercee' => '',
                'date_cessation' => '',
                'lien_ppe' => '',
                'regime_social' => '',
                'madelin' => '',
                'besoins_deces' => '',
                'besoins_incapacite' => '',
                'besoins_dependance' => '',
                'besoins_specifiques' => '',
                'description_besoin' => '',
                'type_souscription' => '',
            ],
            'mutuelle_individuelle_3' => [
                'besoins_specifiques' => '',
            ],
            'mandat_immo_1' => [
                'civilite' => '',
                'type_client' => 'PARTICULIER',
                'nom_client' => '',
                'nom_conseiller' => 'Raphaël JACOB',
                'fait_a' => 'Paris',
                'date_document' => now()->format('Y-m-d'),
            ],
            'mandat_immo_2' => [
                'besoins_specifiques' => '',
            ],
            'mandat_immo_3' => [
                'besoins_specifiques' => '',
            ],                        
            // Ajoutez d'autres templates ici...
        ];

        return $defaults[$template] ?? [];
    }
}