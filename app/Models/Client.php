<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'statut', 'email', 'telephone', 'telephone_portable',
        'adresse', 'code_postal', 'ville', 'pays',
        // Particulier
        'civilite', 'nom', 'prenom', 'date_naissance', 'situation_familiale', 'nombre_enfants',
        'profession', 'employeur',  'type_contrat',
        'residence_principale', 'immobilier_locatif', 'assurance_vie', 'epargne_retraite',
        // Entreprise
        'raison_sociale', 'statut_juridique', 'siren', 'siret', 'chiffre_affaires', 'effectifs', 'secteur_activite',
        'dirigeant_nom', 'dirigeant_prenom', 'dirigeant_fonction',
        'contact_principal_nom', 'contact_principal_prenom', 'contact_principal_fonction',
        'contact_principal_email', 'contact_principal_telephone',
        'pappers_data', 'pappers_last_update',

        'nationalite', 'regime_matrimonial', 'enfants','revebus_details',
        'patrimoine_immobilier', 'patrimoine_mobilier',
        'nombre_associes', 'repartition_capital', 'associes',
        'ca_entreprise', 'rn_entreprise', 'valorisation_entreprise',
        'commentaires','documents'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'chiffre_affaires' => 'decimal:2',
        'residence_principale' => 'boolean',
        'immobilier_locatif' => 'boolean',
        'assurance_vie' => 'boolean',
        'epargne_retraite' => 'boolean',
        'pappers_data' => 'array',
        'pappers_last_update' => 'datetime',
        'enfants' => 'array',

        'revenus_details' => 'array', 
        'patrimoine_immobilier' => 'array',
        'patrimoine_mobilier' => 'array',
        'associes' => 'array',
        'commentaires' => 'array',
        'documents' => 'array',
    ];

    // Accesseurs
    public function getNomCompletAttribute()
    {
        if ($this->type === 'particulier') {
            return trim($this->civilite . ' ' . $this->prenom . ' ' . $this->nom);
        }
        
        return $this->raison_sociale;
    }

    public function getAdresseCompleteAttribute()
    {
        return trim($this->adresse . ' ' . $this->code_postal . ' ' . $this->ville);
    }

    // Scopes
    public function scopeParticuliers($query)
    {
        return $query->where('type', 'particulier');
    }

    public function scopeEntreprises($query)
    {
        return $query->where('type', 'entreprise');
    }

    public function scopeClients($query)
    {
        return $query->where('statut', 'client');
    }

    public function scopeProspects($query)
    {
        return $query->where('statut', 'prospect');
    }

    // Méthode pour récupérer les données Pappers
    public function updatePappersData()
    {
        if ($this->type !== 'entreprise' || !$this->siren) {
            return false;
        }

        try {
            $response = Http::get('https://api.pappers.fr/v2/entreprise', [
                'api_token' => config('services.pappers.api_key'),
                'siren' => $this->siren,
                'format_etablissement_adresse' => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                $this->update([
                    'pappers_data' => $data,
                    'pappers_last_update' => now(),
                    'raison_sociale' => $data['nom_entreprise'] ?? $this->raison_sociale,
                    'siret' => $data['siege']['siret'] ?? $this->siret,
                    'secteur_activite' => $data['libelle_activite_principale'] ?? $this->secteur_activite,
                    'adresse' => $data['siege']['adresse_ligne_1'] ?? $this->adresse,
                    'code_postal' => $data['siege']['code_postal'] ?? $this->code_postal,
                    'ville' => $data['siege']['ville'] ?? $this->ville,
                ]);

                return true;
            }
        } catch (\Exception $e) {
            \Log::error('Erreur API Pappers: ' . $e->getMessage());
        }

        return false;
    }
/*
    // Relations
    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    */
}