<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreArticlesToInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervention', function (Blueprint $table) {
            $table->integer('nombreArticles')->nullable()->after('ArtId'); // Ajout de la colonne
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
            $table->dropColumn('nombreArticles'); // Suppression de la colonne si la migration est annulée
        });
    }
}
