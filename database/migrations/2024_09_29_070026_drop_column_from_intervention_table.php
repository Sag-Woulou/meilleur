<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnFromInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Supprimer la colonne souhaitée de la table intervention
        Schema::table('intervention', function (Blueprint $table) {
            $table->dropColumn('nombreArticles'); // Remplacez 'nom_de_la_colonne' par le nom réel de la colonne que vous souhaitez supprimer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rétablir la colonne dans la table intervention
        Schema::table('intervention', function (Blueprint $table) {
            $table->string('nombreArticles'); // Changez le type selon vos besoins (par exemple, integer, string, etc.)
        });
    }
}
