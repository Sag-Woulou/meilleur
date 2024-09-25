<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddArtIdToInterventionTable extends Migration
{
    public function up()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Ajout de la colonne ArtId
            $table->unsignedInteger('ArtId')->nullable();

            // Clé étrangère avec NO ACTION
            $table->foreign('ArtId')->references('ArtId')->on('Articles')->onDelete('no action');
        });

        // Remplir la colonne avec des valeurs aléatoires entre 1 et 1000
        DB::table('intervention')->update([
            'ArtId' => DB::raw('FLOOR(RAND() * 1000) + 1')
        ]);
    }

    public function down()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Supprimer la clé étrangère
            $table->dropForeign(['ArtId']);
            // Supprimer la colonne ArtId
            $table->dropColumn('ArtId');
        });
    }
}
