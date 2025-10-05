<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientController extends Controller
{
        public function index()
    {
        // Calcul des statistiques
        $stats = [
            'total' => Client::count(),
            'prospects' => Client::where('statut', 'prospect')->count(),
            'particuliers' => Client::where('type', 'particulier')->count(),
            'entreprises' => Client::where('type', 'entreprise')->count(),
        ];

        return view('clients.index', compact('stats'));
    }

    /**
     * Données pour DataTables
     */
    public function datatable(Request $request)
    {
        $query = Client::select([
            'id', 'type', 'statut', 'civilite', 'nom', 'prenom', 
            'raison_sociale', 'secteur_activite', 'email', 'telephone', 
            'telephone_portable', 'adresse', 'ville', 'code_postal', 'created_at'
        ]);

        // Application des filtres
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        // Recherche globale
        if ($request->filled('search_global')) {
            $search = $request->search_global;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('raison_sociale', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%")
                  ->orWhere('telephone_portable', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('nom_complet', function($client) {
                if ($client->type === 'particulier') {
                    return trim(($client->civilite ? $client->civilite . ' ' : '') . 
                               $client->prenom . ' ' . $client->nom);
                } else {
                    return $client->raison_sociale;
                }
            })
            ->addColumn('contact', function($client) {
                $contact = [];
                if ($client->email) $contact[] = $client->email;
                if ($client->telephone) $contact[] = $client->telephone;
                if ($client->telephone_portable) $contact[] = $client->telephone_portable;
                return implode(' | ', $contact);
            })
            ->addColumn('actions', function($client) {
                //return view('clients.partials.actions', compact('client'))->render();
                $buttons = '';
                $buttons .= '<a class="btn btn-primary mb-3 mr-2"  target="_blank" href="' . route('clients.edit', $client->id) . '" style="float:left" title="Modifier"><i class="fas fa-edit"></i></a>';
                $buttons .= '<a class="btn btn-success mb-3 mr-2" target="_blank" href="' . route('clients.show', $client->id) . '" style="float:left" title="Ouvrir"><i class="fas fa-eye"></i></a>';
                $buttons .= '<form action="' . route('clients.destroy', $client->id) . '" method="POST" style="float:left" class="mr-2">';
                $buttons .= csrf_field();
                $buttons .= method_field('DELETE');
                $buttons .= '<button type="submit" class="btn btn-danger mb-3" title="Supprimer" onclick="return ConfirmDelete();"><i class="fas fa-trash"></i></button>';
                $buttons .= '</form>';
                return $buttons;

            })
            ->addColumn('avatar', function($client) {
            //    return view('clients.partials.actions', compact('client'))->render();
            })
            ->rawColumns(['avatar','actions'])
            ->make(true);
	}

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();
        
        // Convertir les tableaux JSON si nécessaire
        if (isset($data['enfants'])) {
            $data['enfants'] = array_values(array_filter($data['enfants'], function($enfant) {
                return !empty($enfant['nom']) || !empty($enfant['prenom']);
            }));
        }
        
        if (isset($data['associes'])) {
            $data['associes'] = array_values(array_filter($data['associes'], function($associe) {
                return !empty($associe['nom']) || !empty($associe['prenom']);
            }));
        }
        
        if (isset($data['revenus_details'])) {
            $data['revenus_details'] = array_values(array_filter($data['revenus_details'], function($revenu) {
                return !empty($revenu['type']) && !empty($revenu['montant']);
            }));
        }
        
        if (isset($data['patrimoine_immobilier'])) {
            $data['patrimoine_immobilier'] = array_values(array_filter($data['patrimoine_immobilier'], function($bien) {
                return !empty($bien['type_bien']);
            }));
        }
        
        if (isset($data['patrimoine_mobilier'])) {
            $data['patrimoine_mobilier'] = array_values(array_filter($data['patrimoine_mobilier'], function($contrat) {
                return !empty($contrat['type_contrat']);
            }));
        }
        
        if (isset($data['commentaires'])) {
            $data['commentaires'] = array_values(array_filter($data['commentaires'], function($commentaire) {
                return !empty($commentaire['texte']);
            }));
        }
        
        // Initialiser documents comme tableau vide si non présent
        if (!isset($data['documents'])) {
            $data['documents'] = [];
        }
        
        $client = Client::create($data);

        // Si c'est une entreprise avec SIREN, récupérer les données Pappers
        if ($client->type === 'entreprise' && $client->siren) {
            $client->updatePappersData();
        }

        return redirect()->route('clients.show', $client)
                        ->with('success', 'Client créé avec succès.');
    }

    public function show(Client $client)
    {
        //$client->load(['contrats', 'dossiers', 'notes', 'documents']);
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $data = $request->validated();
        
        // Convertir les tableaux JSON et filtrer les entrées vides
        if (isset($data['enfants'])) {
            $data['enfants'] = array_values(array_filter($data['enfants'], function($enfant) {
                return !empty($enfant['nom']) || !empty($enfant['prenom']);
            }));
        } else {
            $data['enfants'] = [];
        }
        
        if (isset($data['associes'])) {
            $data['associes'] = array_values(array_filter($data['associes'], function($associe) {
                return !empty($associe['nom']) || !empty($associe['prenom']);
            }));
        } else {
            $data['associes'] = [];
        }
        
        if (isset($data['revenus_details'])) {
            $data['revenus_details'] = array_values(array_filter($data['revenus_details'], function($revenu) {
                return !empty($revenu['type']) && !empty($revenu['montant']);
            }));
        } else {
            $data['revenus_details'] = [];
        }
        
        if (isset($data['patrimoine_immobilier'])) {
            $data['patrimoine_immobilier'] = array_values(array_filter($data['patrimoine_immobilier'], function($bien) {
                return !empty($bien['type_bien']);
            }));
        } else {
            $data['patrimoine_immobilier'] = [];
        }
        
        if (isset($data['patrimoine_mobilier'])) {
            $data['patrimoine_mobilier'] = array_values(array_filter($data['patrimoine_mobilier'], function($contrat) {
                return !empty($contrat['type_contrat']);
            }));
        } else {
            $data['patrimoine_mobilier'] = [];
        }
        
        if (isset($data['commentaires'])) {
            $data['commentaires'] = array_values(array_filter($data['commentaires'], function($commentaire) {
                return !empty($commentaire['texte']);
            }));
        } else {
            $data['commentaires'] = [];
        }
        
        // Conserver les documents existants si pas de mise à jour
        if (!isset($data['documents'])) {
            $data['documents'] = $client->documents ?? [];
        }
        
        $client->update($data);

        // Si c'est une entreprise avec SIREN, rafraîchir les données Pappers si le SIREN a changé
        if ($client->type === 'entreprise' && $client->siren && $client->wasChanged('siren')) {
            $client->updatePappersData();
        }

        return redirect()->route('clients.show', $client)
                        ->with('success', 'Client modifié avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        
        return redirect()->route('clients.index')
                        ->with('success', 'Client supprimé avec succès.');
    }

    // API pour récupérer les infos d'une entreprise via SIREN
    public function getSirenData(Request $request)
    {
        $request->validate([
            'siren' => 'required|string|size:9'
        ]);

        try {
            $response = Http::get('https://api.pappers.fr/v2/entreprise', [
                'api_token' => config('services.pappers.api_key'),
                'siren' => $request->siren,
                'format_etablissement_adresse' => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return response()->json([
                    'success' => true,
                    'data' => [
                        'raison_sociale' => $data['nom_entreprise'] ?? '',
                        'siret' => $data['siege']['siret'] ?? '',
                        'secteur_activite' => $data['libelle_activite_principale'] ?? '',
                        'adresse' => $data['siege']['adresse_ligne_1'] ?? '',
                        'code_postal' => $data['siege']['code_postal'] ?? '',
                        'ville' => $data['siege']['ville'] ?? '',
                        'statut_juridique' => $data['forme_juridique'] ?? '',
                        'effectifs' => $data['effectif'] ?? null,
                        'chiffre_affaires' => $data['derniers_comptes']['chiffre_affaires'] ?? null,
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Entreprise non trouvée'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des données'
            ], 500);
        }
    }

    // Convertir un prospect en client
    public function convertToClient(Client $client)
    {
        if ($client->statut === 'prospect') {
            $client->update(['statut' => 'client']);
            
            return redirect()->back()
                            ->with('success', 'Prospect converti en client avec succès.');
        }

        return redirect()->back()
                        ->with('error', 'Ce prospect est déjà un client.');
    }
	
	
	
	
	 public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:prospect,client,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:clients,id'
        ]);

        try {
            $count = 0;
            $clients = Client::whereIn('id', $request->ids);

            switch ($request->action) {
                case 'prospect':
                    $count = $clients->update(['statut' => 'prospect']);
                    $message = "{$count} client(s) marqué(s) comme prospect";
                    break;

                case 'client':
                    $count = $clients->update(['statut' => 'client']);
                    $message = "{$count} client(s) marqué(s) comme client";
                    break;

                case 'delete':
                    $count = $clients->delete();
                    $message = "{$count} client(s) supprimé(s)";
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'count' => $count
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'action : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retourne la liste des villes pour les filtres
     */
    public function cities()
    {
        $cities = Client::whereNotNull('ville')
                       ->where('ville', '!=', '')
                       ->distinct()
                       ->orderBy('ville')
                       ->pluck('ville');

        return response()->json($cities);
    }

    /**
     * Export des données en Excel
     */
    public function exportExcel(Request $request)
    {
        // Cette méthode nécessite une librairie comme Laravel Excel
        // Installation : composer require maatwebsite/excel
        
        /*
        return Excel::download(new ClientsExport($request->all()), 'clients.xlsx');
        */
        
        return response()->json([
            'message' => 'Fonctionnalité d\'export Excel à implémenter avec Laravel Excel'
        ]);
    }

    /**
     * Export des données en PDF
     */
    public function exportPdf(Request $request)
    {
        // Cette méthode nécessite une librairie comme DomPDF
        // Installation : composer require barryvdh/laravel-dompdf
        
        /*
        $clients = $this->getFilteredClients($request);
        $pdf = PDF::loadView('clients.pdf', compact('clients'));
        return $pdf->download('clients.pdf');
        */
        
        return response()->json([
            'message' => 'Fonctionnalité d\'export PDF à implémenter avec DomPDF'
        ]);
    }

    /**
     * Export des données en CSV
     */
    public function exportCsv(Request $request)
    {
        $clients = $this->getFilteredClients($request);
        
        $filename = 'clients_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($clients) {
            $file = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($file, [
                'ID', 'Type', 'Statut', 'Civilité', 'Nom', 'Prénom', 
                'Raison Sociale', 'Email', 'Téléphone', 'Portable',
                'Adresse', 'Ville', 'Code Postal', 'Créé le'
            ]);

            // Données
            foreach ($clients as $client) {
                fputcsv($file, [
                    $client->id,
                    $client->type,
                    $client->statut,
                    $client->civilite,
                    $client->nom,
                    $client->prenom,
                    $client->raison_sociale,
                    $client->email,
                    $client->telephone,
                    $client->telephone_portable,
                    $client->adresse,
                    $client->ville,
                    $client->code_postal,
                    $client->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Méthode helper pour récupérer les clients filtrés
     */
    private function getFilteredClients(Request $request)
    {
        $query = Client::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('ville')) {
            $query->where('ville', 'like', '%' . $request->ville . '%');
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        if ($request->filled('search_global')) {
            $search = $request->search_global;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('raison_sociale', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%")
                  ->orWhere('telephone_portable', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Mise à jour du statut d'un client
     */
    public function updateStatus(Request $request, Client $client)
    {
        $request->validate([
            'statut' => 'required|in:client,prospect'
        ]);

        $client->update(['statut' => $request->statut]);

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour avec succès',
            'client' => $client
        ]);
    }

    /**
     * Recherche de clients (pour l'autocomplete)
     */
    public function search(Request $request)
    {
        $term = $request->get('term');
        
        $clients = Client::where(function($query) use ($term) {
            $query->where('nom', 'like', "%{$term}%")
                  ->orWhere('prenom', 'like', "%{$term}%")
                  ->orWhere('raison_sociale', 'like', "%{$term}%")
                  ->orWhere('email', 'like', "%{$term}%");
        })
        ->limit(10)
        ->get()
        ->map(function($client) {
            return [
                'id' => $client->id,
                'label' => $client->type === 'particulier' 
                    ? trim($client->prenom . ' ' . $client->nom)
                    : $client->raison_sociale,
                'value' => $client->id,
                'type' => $client->type,
                'statut' => $client->statut,
                'email' => $client->email
            ];
        });

        return response()->json($clients);
    }



    public function updateDocuments(Request $request, Client $client)
    {
        $request->validate([
            'new_documents' => 'nullable|array',
            'new_documents.*.file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
            'new_documents.*.nom' => 'required|string|max:255',
            'new_documents.*.type' => 'nullable|string',
            'new_documents.*.date' => 'nullable|date',
            'new_documents.*.note' => 'nullable|string',
            'updated_documents' => 'nullable|array',
            'deleted_documents' => 'nullable|array',
        ]);

        $documents = $client->documents ?? [];

        // Gérer les suppressions
        if ($request->has('deleted_documents')) {
            foreach ($request->deleted_documents as $index) {
                if (isset($documents[$index])) {
                    // Supprimer le fichier physique si nécessaire
                    if (isset($documents[$index]['path']) && Storage::exists($documents[$index]['path'])) {
                        Storage::delete($documents[$index]['path']);
                    }
                    unset($documents[$index]);
                }
            }
            $documents = array_values($documents);
        }

        // Gérer les mises à jour
        if ($request->has('updated_documents')) {
            foreach ($request->updated_documents as $index => $updates) {
                if (isset($documents[$index])) {
                    $documents[$index] = array_merge($documents[$index], $updates);
                }
            }
        }

        // Gérer les nouveaux documents
        if ($request->has('new_documents')) {
            foreach ($request->new_documents as $newDoc) {
                if (isset($newDoc['file'])) {
                    $file = $newDoc['file'];
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('documents/clients/' . $client->id, $filename, 'private');

                    $documents[] = [
                        'nom' => $newDoc['nom'] ?? $file->getClientOriginalName(),
                        'type' => $newDoc['type'] ?? '',
                        'date' => $newDoc['date'] ?? now()->format('Y-m-d'),
                        'note' => $newDoc['note'] ?? '',
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                        'uploaded_at' => now()->toDateTimeString(),
                    ];
                }
            }
        }

        $client->update(['documents' => $documents]);

        return response()->json([
            'success' => true,
            'message' => 'Documents mis à jour avec succès',
            'documents' => $documents
        ]);
    }


    public function downloadDocument(Client $client, $documentIndex)
    {
        $documents = $client->documents ?? [];
        
        if (!isset($documents[$documentIndex])) {
            abort(404, 'Document non trouvé');
        }

        $document = $documents[$documentIndex];
        
        if (!isset($document['path']) || !Storage::exists($document['path'])) {
            abort(404, 'Fichier non trouvé');
        }

        return Storage::download($document['path'], $document['nom']);
    }
}