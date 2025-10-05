<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToClientsTable extends Migration
{
 
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Champs particulier - Informations personnelles
            $table->string('nationalite', 100)->nullable()->after('date_naissance');
            $table->string('regime_matrimonial', 100)->nullable()->after('situation_familiale');
            
            // Enfants (JSON)
            $table->json('enfants')->nullable()->after('nombre_enfants');
            
            // Situation financière - Revenus détaillés (JSON array)
            // On crée une nouvelle colonne pour les revenus détaillés
            $table->json('revenus_details')->nullable()->after('nombre_enfants');
            
            // Patrimoine immobilier (JSON)
            $table->json('patrimoine_immobilier')->nullable()->after('immobilier_locatif');
            
            // Patrimoine mobilier (JSON)
            $table->json('patrimoine_mobilier')->nullable()->after('patrimoine_immobilier');
            
            // Champs entreprise - Informations légales
            $table->integer('nombre_associes')->nullable()->after('siret');
            $table->text('repartition_capital')->nullable()->after('nombre_associes');
            
            // Associés (JSON)
            $table->json('associes')->nullable()->after('repartition_capital');
            
            // Éléments financiers entreprise
            $table->decimal('ca_entreprise', 15, 2)->nullable()->after('chiffre_affaires');
            $table->decimal('rn_entreprise', 15, 2)->nullable()->after('ca_entreprise');
            $table->decimal('valorisation_entreprise', 15, 2)->nullable()->after('rn_entreprise');
            
            // Commentaires (JSON)
            $table->json('commentaires')->nullable()->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'nationalite',
                'regime_matrimonial',
                'enfants',
                'revenus_details',
                'patrimoine_immobilier',
                'patrimoine_mobilier',
                'nombre_associes',
                'repartition_capital',
                'associes',
                'ca_entreprise',
                'rn_entreprise',
                'valorisation_entreprise',
                'commentaires',
            ]);
        });
    }
}
