<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            
            // Type de client
            $table->enum('type', ['particulier', 'entreprise']);
            $table->enum('statut', ['client', 'prospect'])->default('prospect');
            
            // Informations communes
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('telephone_portable')->nullable();
            
            // Adresse
            $table->text('adresse')->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->default('France');
            
            // Particulier
            $table->enum('civilite', ['M', 'Mme', 'Mlle'])->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('situation_familiale', ['celibataire', 'marie', 'pacs', 'divorce', 'veuf'])->nullable();
            $table->integer('nombre_enfants')->default(0);
            
            // Situation professionnelle (particulier)
            $table->string('profession')->nullable();
            $table->string('employeur')->nullable();
            //$table->decimal('revenus', 10, 2)->nullable();
            $table->enum('type_contrat', ['cdi', 'cdd', 'interim', 'freelance', 'retraite', 'chomage'])->nullable();
            
            // Patrimoine (particulier)
            $table->boolean('residence_principale')->default(false);
            $table->boolean('immobilier_locatif')->default(false);
            $table->boolean('assurance_vie')->default(false);
            $table->boolean('epargne_retraite')->default(false);
            
            // Entreprise
            $table->string('raison_sociale')->nullable();
            $table->enum('statut_juridique', ['SARL', 'SAS', 'SA', 'EURL', 'Auto-entrepreneur', 'SCI', 'Autre'])->nullable();
            $table->string('siren', 14)->nullable();
            $table->string('siret', 17)->nullable();
            $table->decimal('chiffre_affaires', 12, 2)->nullable();
            $table->integer('effectifs')->nullable();
            $table->string('secteur_activite')->nullable();
            
            // Dirigeants/Contact principal (entreprise)
            $table->string('dirigeant_nom')->nullable();
            $table->string('dirigeant_prenom')->nullable();
            $table->string('dirigeant_fonction')->nullable();
            $table->string('contact_principal_nom')->nullable();
            $table->string('contact_principal_prenom')->nullable();
            $table->string('contact_principal_fonction')->nullable();
            $table->string('contact_principal_email')->nullable();
            $table->string('contact_principal_telephone')->nullable();
            $table->text('notes')->nullable();
            
            // Données Pappers (entreprise)
            $table->json('pappers_data')->nullable();
            $table->timestamp('pappers_last_update')->nullable();
            
            $table->timestamps();
            
            // Index
            $table->index(['type', 'statut']);
            $table->index('email');
            $table->index('siren');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
