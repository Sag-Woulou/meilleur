<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropArtIdFromInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Supprimer la clé étrangère si elle existe
            $table->dropForeign(['ArtId']);
            // Supprimer la colonne ArtId
            $table->dropColumn('ArtId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Ajouter à nouveau la colonne ArtId
            $table->unsignedInteger('ArtId')->nullable();
            // Définir la clé étrangère
            $table->foreign('ArtId')->references('ArtId')->on('Articles')->onDelete('no action');
        });
    }
}
