<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocumentData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    private $templates = [
        'mutuelle_individuelle_1' => 'Document d\'entrée en Relation - Mutuelle Individuelle',
        'mutuelle_individuelle_2' => 'Document de Recueil des Exigences - Prévoyance - Mutuelle Individuelle',
        'mutuelle_individuelle_3' => 'Fiche Conseil - Mutuelle Individuelle',
        'mandat_immo_1' => 'Document d’entrée en relation - Mandat Immobilier',
        'mandat_immo_2' => 'Convention de Prestations d\'assistance et de recherche en financement - Mandat Immobilier',
        'mandat_immo_3' => 'Mandat de Recherche de Bien Immobilier - Mandat Immobilier',
        'mandat_financement_1' => '',
        'mandat_financement_2' => 'Convention de Prestations d\'assistance et de recherche en financement - Mandat Financement',
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
        $situations = [
            'celibataire' => 'Célibataire', 
            'marie' => 'Marié(e)', 
            'pacs' => 'Pacsé(e)', 
            'divorce' => 'Divorcé(e)', 
            'veuf' => 'Veuf(ve)'
        ];

        $regimes = [
            'communaute_reduite_acquets' => 'Communauté réduite aux acquêts',
            'separation_biens' => 'Séparation de biens',
            'communaute_universelle' => 'Communauté universelle',
            'participation_acquets' => 'Participation aux acquêts'
        ];

        // Données de base du client (toujours les mêmes)
        $baseData = [
            'civilite' => $client->civilite ?? '',
            'nom_usage' => $client->nom ?? '',
            'nom_naissance' => $client->nom ?? '',
            'prenoms' => $client->prenom ?? '',
            'date_naissance' => $client->date_naissance?->format('d/m/Y') ?? '',
            'lieu_naissance' => $client->lieu_naissance ?? '',
            'situation_familiale' => $situations[$client->situation_familiale] ?? '',
            'regime_matrimonial' => $regimes[$client->regime_matrimonial] ?? '',
            'adresse' => $client->adresse_complete ?? '',
            'email' => $client->email ?? '',
            'telephone_mobile' => $client->telephone_portable ?? '',
            'telephone' => $client->telephone ?? '',
            'profession' => $client->profession ?? '',
            'nom_complet' => $client->nom_complet ?? '',
            'raison_sociale' => $client->raison_sociale ?? '',
            'siren' => $client->siren ?? '',
            'siret' => $client->siret ?? '',
            'date_document' => now()->format('Y-m-d'),
            
            // Informations conjoint
            'conjoint_civilite' => $client->conjoint_civilite ?? '',
            'conjoint_nom' => $client->conjoint_nom ?? '',
            'conjoint_prenom' => $client->conjoint_prenom ?? '',
            'conjoint_date_naissance' => $client->conjoint_date_naissance ? 
                (is_string($client->conjoint_date_naissance) ? $client->conjoint_date_naissance : $client->conjoint_date_naissance->format('d/m/Y')) : '',
            'conjoint_nationalite' => $client->conjoint_nationalite ?? '',
            'conjoint_nom2' => $client->conjoint_nom2 ?? '',
            'conjoint_date_mariage' => $client->conjoint_date_mariage ? 
                (is_string($client->conjoint_date_mariage) ? $client->conjoint_date_mariage : $client->conjoint_date_mariage->format('d/m/Y')) : '',
            'conjoint_lieu_mariage' => $client->conjoint_lieu_mariage ?? '',
            'conjoint_profession' => $client->conjoint_profession ?? '',
            'conjoint_employeur' => $client->conjoint_employeur ?? '',
            
            // Informations professionnelles
            'type_contrat' => $client->type_contrat ?? '',
            'employeur' => $client->employeur ?? '',
            
            // Patrimoine (flags)
            'residence_principale' => $client->residence_principale ? 'Oui' : 'Non',
            'immobilier_locatif' => $client->immobilier_locatif ? 'Oui' : 'Non',
            'assurance_vie' => $client->assurance_vie ? 'Oui' : 'Non',
            'epargne_retraite' => $client->epargne_retraite ? 'Oui' : 'Non',
            
            // Entreprise
            'statut_juridique' => $client->statut_juridique ?? '',
            'chiffre_affaires' => $client->chiffre_affaires ?? '',
            'effectifs' => $client->effectifs ?? '',
            'secteur_activite' => $client->secteur_activite ?? '',
            'nombre_associes' => $client->nombre_associes ?? '',
            'repartition_capital' => $client->repartition_capital ?? '',
            
            // Dirigeant
            'dirigeant_nom' => $client->dirigeant_nom ?? '',
            'dirigeant_prenom' => $client->dirigeant_prenom ?? '',
            'dirigeant_fonction' => $client->dirigeant_fonction ?? '',
            
            // Contact principal
            'contact_principal_nom' => $client->contact_principal_nom ?? '',
            'contact_principal_prenom' => $client->contact_principal_prenom ?? '',
            'contact_principal_fonction' => $client->contact_principal_fonction ?? '',
            'contact_principal_email' => $client->contact_principal_email ?? '',
            'contact_principal_telephone' => $client->contact_principal_telephone ?? '',
            
            // Autres
            'nationalite' => $client->nationalite ?? '',
            
            // Enfants - récupération depuis le JSON
            'nb_enfants' => isset($client->enfants) && is_array($client->enfants) ? count($client->enfants) : 0,
        ];

        // Ajouter les enfants s'ils existent
        if (isset($client->enfants) && is_array($client->enfants)) {
            foreach ($client->enfants as $index => $enfant) {
                $num = $index + 1;
                $baseData["enfant{$num}_nom"] = ($enfant['prenom'] ?? '') . ' ' . ($enfant['nom'] ?? '');
                $baseData["enfant{$num}_date"] = $enfant['date_naissance'] ?? '';
            }
        }

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
                'note_hospitalisation' => '',
                'note_consultation'    => '',
                'note_optique'         => '',
                'note_dentaire'        => '',
                'note_prevention'      => '',
                'ppe' => '',
            ],
            'mutuelle_individuelle_3' => [
                'besoins_specifiques' => '',
            ],
            'mandat_immo_1' => [
                'civilite' => '',
                'type_client' => '',
                'nom_client' => '',
                'nom_conseiller' => 'Raphaël JACOB',
                'fait_a' => 'Paris',
            ],
            'mandat_immo_2' => [
                'nom_client1' => '',
                'prenom_client1' => '',
                'adresse_client1' => '',
                'date_naissance_client1' => '',
                'civilite_client2' => '',
                'nom_client2' => '',
                'prenom_client2' => '',
                'adresse_client2' => '',
                'date_naissance_client2' => '',
                'montant_credit' => '',
                'apport_personnel' => '',
                'objet_financement' => 'Achat',
                'destination' => 'Achat résidence principale sans travaux',
                'nom_conseiller' => 'Raphaël JACOB',
                'fait_a' => 'Paris',
                'date_debut_mandat' => now()->format('Y-m-d'),
                'date_fin_mandat' => now()->addMonths(3)->format('Y-m-d'),
                'montant_honoraires' => '',
            ],
            'mandat_immo_3' => [
                'nature_bien' => '',
                'localisation' => '',
                'surface_souhaitee' => '',
                'nombre_pieces' => '',
                'budget_min' => '',
                'budget_max' => '',
                'criteres_supplementaires' => '',
                'apport_personnel' => '',
                'accord_bancaire' => 'non',
                'capacite_emprunt' => '',
                'delai_acquisition' => 'moyen_terme',
                'disponibilite_visites' => '',
                'date_debut_mandat' => now()->format('Y-m-d'),
                'date_fin_mandat' => now()->addMonths(6)->format('Y-m-d'),
                'montant_honoraires' => '',
                'type_mandat' => 'simple',
                'commentaires' => '',
                'nom_conseiller' => 'Raphaël JACOB',
                'fait_a' => 'Paris',
                'date_document' => now()->format('Y-m-d'),
            ],  
            'mandat_financement_2' => [
                // Données du projet
                'date_rdv' => now()->format('Y-m-d'),
                'nature_projet' => '',
                'destination_logement' => '',
                
                // Coût du projet
                'prix_acquisition' => 0,
                'frais_notaire' => 0,
                'frais_agence' => 0,
                'travaux' => 0,
                'ira' => 0,
                'frais_garantie' => 0,
                'frais_banque' => 0,
                'honoraires_courtage' => 0,
                'apport_personnel' => 0,
                'dont_epargne' => 0,
                'dont_donation' => 0,
                
                // Échéance
                'date_signature' => '',
                'priorite' => '',
                'projet_societe' => '',
                
                // Objectifs (11 objectifs)
                'objectif_constituer_patrimoine' => false,
                'objectif_constituer_patrimoine_commentaire' => '',
                'objectif_revenus_complementaires' => false,
                'objectif_revenus_complementaires_commentaire' => '',
                'objectif_proteger_proches' => false,
                'objectif_proteger_proches_commentaire' => '',
                'objectif_aider_enfants' => false,
                'objectif_aider_enfants_commentaire' => '',
                'objectif_optimiser_fiscalite' => false,
                'objectif_optimiser_fiscalite_commentaire' => '',
                'objectif_preparer_retraite' => false,
                'objectif_preparer_retraite_commentaire' => '',
                'objectif_financer_achat' => false,
                'objectif_financer_achat_commentaire' => '',
                'objectif_preparer_transmission' => false,
                'objectif_preparer_transmission_commentaire' => '',
                'objectif_optimiser_rentabilite' => false,
                'objectif_optimiser_rentabilite_commentaire' => '',
                'objectif_proteger_conjoint' => false,
                'objectif_proteger_conjoint_commentaire' => '',
                'objectif_transmission_entreprise' => false,
                'objectif_transmission_entreprise_commentaire' => '',
                
                // Informations personnelles Client 1
                'client1_nom' => '',
                'client1_nom_patronymique' => '',
                'client1_situation' => '',
                'client1_regime' => '',
                'client1_date_naissance' => '',
                'client1_lieu_naissance' => '',
                'client1_nationalite' => '',
                'client1_nb_enfants' => 0,
                'client1_adresse' => '',
                
                // Informations personnelles Client 2
                'client2_nom' => '',
                'client2_nom_patronymique' => '',
                'client2_situation' => '',
                'client2_regime' => '',
                'client2_date_naissance' => '',
                'client2_lieu_naissance' => '',
                'client2_nationalite' => '',
                'client2_nb_enfants' => 0,
                'client2_adresse' => '',
                
                // Mariage/Divorce/Pension
                'date_mariage' => '',
                'date_divorce' => '',
                'pension_type' => '',
                'pension_montant' => 0,
                
                // Logement actuel Client 1
                'client1_logement_statut' => '',
                'client1_type_logement' => '',
                'client1_loyer' => 0,
                'client1_depuis' => '',
                
                // Logement actuel Client 2
                'client2_logement_statut' => '',
                'client2_type_logement' => '',
                'client2_loyer' => 0,
                
                // Enfants Client 1 (3 maximum)
                'client1_enfant1_nom' => '',
                'client1_enfant1_date' => '',
                'client1_enfant2_nom' => '',
                'client1_enfant2_date' => '',
                'client1_enfant3_nom' => '',
                'client1_enfant3_date' => '',
                
                // Enfants Client 2 (3 maximum)
                'client2_enfant1_nom' => '',
                'client2_enfant1_date' => '',
                'client2_enfant2_nom' => '',
                'client2_enfant2_date' => '',
                'client2_enfant3_nom' => '',
                'client2_enfant3_date' => '',
                
                // Commentaires
                'commentaire_client1' => '',
                'commentaire_client2' => '',
                
                // Mandat
                'montant_credit' => 0,
                'objet_financement' => 'Achat habitation principale',
                'destination' => 'Achat résidence principale sans travaux',
                'fait_a' => 'Paris',
                'date_debut_mandat' => now()->format('Y-m-d'),
                'date_fin_mandat' => now()->addMonths(3)->format('Y-m-d'),
            ],                             
            // Ajoutez d'autres templates ici...
        ];

        return $defaults[$template] ?? [];
    }
}