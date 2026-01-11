<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDocumentData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_document_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('template_key'); // ex: 'mutuelle_individuelle_1'
            $table->json('data'); // Stocker toutes les données du formulaire
            $table->timestamps();
            
            // Un client ne peut avoir qu'une seule version de données par template
            $table->unique(['client_id', 'template_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_document_data');
    }
}
