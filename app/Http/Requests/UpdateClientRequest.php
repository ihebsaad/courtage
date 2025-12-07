<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'type' => 'required|in:particulier,entreprise',
            'statut' => 'required|in:client,prospect',
            'email' => 'nullable|email|unique:clients,email,' . $this->client->id,
            'nationalite' => 'nullable|string|max:30',
            'telephone' => 'nullable|string|max:20',
            'telephone_portable' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'code_postal' => 'nullable|string|max:10',
            'ville' => 'nullable|string|max:100',
            'pays' => 'string|max:100',
            'commentaires' => 'nullable|array',
            'commentaires.*.date' => 'nullable|date',
            'commentaires.*.texte' => 'nullable|string',        
        ];

        if ($this->type === 'particulier') {
            $rules = array_merge($rules, [
                'civilite' => 'required|in:M,Mme,Mlle',
                'nom' => 'required|string|max:100',
                'prenom' => 'required|string|max:100',
                'date_naissance' => 'nullable|date|before:today',
                'situation_familiale' => 'nullable|in:celibataire,marie,pacs,divorce,veuf',
                'regime_matrimonial' => 'nullable|in:communaute_reduite_acquets,separation_biens,communaute_universelle,participation_acquets',
                'nombre_enfants' => 'integer|min:0|max:20',
                'profession' => 'nullable|string|max:100',
                'employeur' => 'nullable|string|max:100',
                'type_contrat' => 'nullable|in:cdi,cdd,interim,freelance,retraite,chomage',
                'residence_principale' => 'boolean',
                'immobilier_locatif' => 'boolean',
                'assurance_vie' => 'boolean',
                'epargne_retraite' => 'boolean',

                'enfants' => 'nullable|array',
                'enfants.*.civilite' => 'nullable|string',
                'enfants.*.nom' => 'nullable|string',
                'enfants.*.prenom' => 'nullable|string',
                'enfants.*.date_naissance' => 'nullable|date',
                
                'revenus_details' => 'nullable|array',
                'revenus_details.*.type' => 'nullable|string',
                'revenus_details.*.montant' => 'nullable|numeric|min:0',
                
                'patrimoine_immobilier' => 'nullable|array',
                'patrimoine_immobilier.*.type_bien' => 'nullable|string',
                'patrimoine_immobilier.*.usage' => 'nullable|string',
                'patrimoine_immobilier.*.destination' => 'nullable|string',
                'patrimoine_immobilier.*.date_achat' => 'nullable|date',
                'patrimoine_immobilier.*.valeur_achat' => 'nullable|numeric|min:0',
                'patrimoine_immobilier.*.valeur_actuelle' => 'nullable|numeric|min:0',
                'patrimoine_immobilier.*.capital_restant' => 'nullable|numeric|min:0',
                'patrimoine_immobilier.*.annuite' => 'nullable|numeric|min:0',
                'patrimoine_immobilier.*.date_fin_pret' => 'nullable|date',
                
                'patrimoine_mobilier' => 'nullable|array',
                'patrimoine_mobilier.*.type_contrat' => 'nullable|string',
                'patrimoine_mobilier.*.montant' => 'nullable|numeric|min:0',
                'patrimoine_mobilier.*.etablissement' => 'nullable|string',
                
                // Conjoint - Pour les particuliers mariés/pacsés
                'conjoint_civilite' => 'nullable|string|in:M,Mme,Mlle',
                'conjoint_nom' => 'nullable|string|max:255',
                'conjoint_prenom' => 'nullable|string|max:255',
                'conjoint_date_naissance' => 'nullable|date|before:today',
                'conjoint_nom2' => 'nullable|string|max:255',
                'conjoint_date_mariage' => 'nullable|date|before:today',
                'conjoint_lieu_mariage' => 'nullable|string|max:255',
                'conjoint_nationalite' => 'nullable|string|max:255',
                'conjoint_profession' => 'nullable|string|max:255',
                'conjoint_employeur' => 'nullable|string|max:255',
            ]);
        } else {
            // Règles pour les entreprises
            $rules = array_merge($rules, [
                'raison_sociale' => 'required|string|max:200',
                'statut_juridique' => 'nullable|in:SARL,SAS,SA,EURL,Auto-entrepreneur,SCI,Autre',
                'siren' => 'nullable|string|size:9|unique:clients,siren,' . $this->client->id,
                'siret' => 'nullable|string|size:14',
                'nombre_associes' => 'nullable|integer|min:1',
                'chiffre_affaires' => 'nullable|numeric|min:0',
                'ca_entreprise' => 'nullable|numeric|min:0',
                'rn_entreprise' => 'nullable|numeric',
                'valorisation_entreprise' => 'nullable|numeric|min:0',
                'effectifs' => 'nullable|integer|min:0',
                'secteur_activite' => 'nullable|string|max:200',
                'repartition_capital' => 'nullable|string|max:255',
                'dirigeant_nom' => 'nullable|string|max:100',
                'dirigeant_prenom' => 'nullable|string|max:100',
                'dirigeant_fonction' => 'nullable|string|max:100',
                'contact_principal_nom' => 'nullable|string|max:100',
                'contact_principal_prenom' => 'nullable|string|max:100',
                'contact_principal_fonction' => 'nullable|string|max:100',
                'contact_principal_email' => 'nullable|email',
                'contact_principal_telephone' => 'nullable|string|max:20',

                'associes' => 'nullable|array',
                'associes.*.nom' => 'nullable|string',
                'associes.*.prenom' => 'nullable|string',
                'associes.*.date_naissance' => 'nullable|date',
                'associes.*.adresse' => 'nullable|string',
                
                // IMPORTANT : Représentant légal - POUR LES ENTREPRISES
                'representant_legal_id' => 'nullable|integer|exists:clients,id',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'type.required' => 'Le type de client est obligatoire.',
            'type.in' => 'Le type de client doit être "particulier" ou "entreprise".',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'siren.size' => 'Le SIREN doit contenir exactement 9 chiffres.',
            'siren.unique' => 'Ce SIREN est déjà enregistré.',
            'siret.size' => 'Le SIRET doit contenir exactement 14 chiffres.',
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'raison_sociale.required' => 'La raison sociale est obligatoire.',
            'date_naissance.before' => 'La date de naissance doit être antérieure à aujourd\'hui.',
            'representant_legal_id.exists' => 'Le représentant légal sélectionné n\'existe pas.',
        ];
    }

    protected function prepareForValidation()
    {
        // Nettoyer les données avant validation
        $input = $this->all();

        // Nettoyer SIREN/SIRET (supprimer espaces et caractères non numériques)
        if (isset($input['siren'])) {
            $input['siren'] = preg_replace('/[^0-9]/', '', $input['siren']);
        }
        
        if (isset($input['siret'])) {
            $input['siret'] = preg_replace('/[^0-9]/', '', $input['siret']);
        }

        // Convertir les booléens
        $booleanFields = ['residence_principale', 'immobilier_locatif', 'assurance_vie', 'epargne_retraite'];
        foreach ($booleanFields as $field) {
            if (isset($input[$field])) {
                $input[$field] = filter_var($input[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }

        $this->replace($input);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier que le représentant légal est bien une personne physique
            if ($this->filled('representant_legal_id')) {
                $client = \App\Models\Client::find($this->representant_legal_id);
                if ($client && $client->type !== 'particulier') {
                    $validator->errors()->add('representant_legal_id', 'Le représentant légal doit être une personne physique.');
                }
            }
        });
    }
}