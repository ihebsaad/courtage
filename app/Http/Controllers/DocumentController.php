<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    private $templates = [
        'mutuelle_individuelle_1' => 'Document DOCUMENT D’ENTREE EN RELATION',
        'mutuelle_individuelle_2' => 'Document de Recueil des Exigences - Prévoyance',
        'mutuelle_individuelle_3' => 'FICHE CONSEIL',
        'mandat_immo_1' => '',
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

        // Préremplir les données depuis le client
        $data = $this->prepareData($client, $template);

        return view("clients.documents.templates.{$template}", [
            'client' => $client,
            'data' => $data,
            'templateName' => $this->templates[$template]
        ]);
    }

    public function generate(Request $request, Client $client, string $template)
    {
        if (!isset($this->templates[$template])) {
            abort(404);
        }

        $data = $request->all();
        
        $pdf = Pdf::loadView("clients.documents.pdf.{$template}", [
            'client' => $client,
            'data' => $data
        ]);

        $filename = "{$template}_{$client->id}_" . now()->format('Y-m-d') . ".pdf";
        
        return $pdf->download($filename);
    }

    private function prepareData(Client $client, string $template)
    {
        $data = [
            'civilite' => $client->civilite,
            'nom_usage' => $client->nom,
            'nom_naissance' => $client->nom,
            'prenoms' => $client->prenom,
            'date_naissance' => $client->date_naissance?->format('d/m/Y'),
            'situation_familiale' => $client->situation_familiale,
            'adresse' => $client->adresse_complete,
            'email' => $client->email,
            'telephone_mobile' => $client->telephone_portable,
            'profession' => $client->profession,
        ];

        // Champs à remplir manuellement
        $data['ppe'] = '';
        $data['fonction_exercee'] = '';
        $data['date_cessation'] = '';
        $data['lien_ppe'] = '';
        $data['regime_social'] = '';
        $data['madelin'] = '';
        $data['besoins_deces'] = '';
        $data['besoins_incapacite'] = '';
        $data['besoins_dependance'] = '';
        $data['besoins_specifiques'] = '';
        $data['description_besoin'] = '';
        $data['type_souscription'] = '';

        return $data;
    }
}