<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            
            $table->string('conjoint_civilite')->nullable()->after('regime_matrimonial');
            $table->string('conjoint_nom')->nullable()->after('conjoint_civilite');
            $table->string('conjoint_prenom')->nullable()->after('conjoint_nom');
            $table->date('conjoint_date_naissance')->nullable()->after('conjoint_prenom');
            $table->string('conjoint_nationalite')->nullable()->after('conjoint_date_naissance');
            $table->string('conjoint_profession')->nullable()->after('conjoint_nationalite');
            $table->string('conjoint_employeur')->nullable()->after('conjoint_profession');
            
            // Champ pour le représentant légal (entreprises)
            $table->unsignedBigInteger('representant_legal_id')->nullable()->after('repartition_capital');
            
            // Clé étrangère
            $table->foreign('representant_legal_id')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['representant_legal_id']);
            $table->dropColumn([
                'conjoint_civilite',
                'conjoint_nom',
                'conjoint_prenom',
                'conjoint_date_naissance',
                'conjoint_nationalite',
                'conjoint_profession',
                'conjoint_employeur',
                'representant_legal_id'
            ]);
        });
    }
}
