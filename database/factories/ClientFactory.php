<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        $type = $this->faker->randomElement(['particulier', 'entreprise']);
        
        $baseData = [
            'type' => $type,
            'statut' => $this->faker->randomElement(['client', 'prospect']),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'telephone_portable' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->streetAddress(),
            'code_postal' => $this->faker->postcode(),
            'ville' => $this->faker->city(),
            'pays' => 'France',
        ];

        if ($type === 'particulier') {
            return array_merge($baseData, [
                'civilite' => $this->faker->randomElement(['M', 'Mme', 'Mlle']),
                'nom' => $this->faker->lastName(),
                'prenom' => $this->faker->firstName(),
                'date_naissance' => $this->faker->dateTimeBetween('-80 years', '-18 years'),
                'situation_familiale' => $this->faker->randomElement(['celibataire', 'marie', 'pacs', 'divorce', 'veuf']),
                'nombre_enfants' => $this->faker->numberBetween(0, 5),
                'profession' => $this->faker->jobTitle(),
                'employeur' => $this->faker->company(),
                'type_contrat' => $this->faker->randomElement(['cdi', 'cdd', 'interim', 'freelance', 'retraite']),
                'residence_principale' => $this->faker->boolean(70),
                'immobilier_locatif' => $this->faker->boolean(30),
                'assurance_vie' => $this->faker->boolean(50),
                'epargne_retraite' => $this->faker->boolean(40),
            ]);
        } else {
            return array_merge($baseData, [
                'raison_sociale' => $this->faker->company(),
                'statut_juridique' => $this->faker->randomElement(['SARL', 'SAS', 'SA', 'EURL', 'Auto-entrepreneur']),
                'siren' => $this->faker->numerify('#########'),
                'siret' => $this->faker->numerify('##############'),
                'chiffre_affaires' => $this->faker->numberBetween(50000, 5000000),
                'effectifs' => $this->faker->numberBetween(1, 500),
                'secteur_activite' => $this->faker->randomElement([
                    'Commerce de détail', 'Services aux entreprises', 'Construction',
                    'Industrie manufacturière', 'Transport', 'Restauration'
                ]),
                'dirigeant_nom' => $this->faker->lastName(),
                'dirigeant_prenom' => $this->faker->firstName(),
                'dirigeant_fonction' => $this->faker->randomElement(['Gérant', 'Président', 'Directeur Général']),
                'contact_principal_nom' => $this->faker->lastName(),
                'contact_principal_prenom' => $this->faker->firstName(),
                'contact_principal_fonction' => $this->faker->randomElement(['Assistant', 'Comptable', 'Secrétaire']),
                'contact_principal_email' => $this->faker->safeEmail(),
                'contact_principal_telephone' => $this->faker->phoneNumber(),
            ]);
        }
    }

    public function particulier()
    {
        return $this->state(function (array $attributes) {
            return ['type' => 'particulier'];
        });
    }

    public function entreprise()
    {
        return $this->state(function (array $attributes) {
            return ['type' => 'entreprise'];
        });
    }

    public function client()
    {
        return $this->state(function (array $attributes) {
            return ['statut' => 'client'];
        });
    }

    public function prospect()
    {
        return $this->state(function (array $attributes) {
            return ['statut' => 'prospect'];
        });
    }
}