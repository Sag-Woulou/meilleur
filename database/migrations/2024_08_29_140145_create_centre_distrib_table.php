<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentreDistribTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Centre_distrib', function (Blueprint $table) {
            $table->id(); // Ajoute une colonne 'id' comme clé primaire
            $table->string('CENTRE_DISTRIBUTION'); // Colonne pour CENTRE_DISTRIBUTION
            $table->string('EXPL_DEPANNAGE'); // Colonne pour EXPL_DEPANNAGE
            $table->string('LIBELLE_EXPL_DEPANNAGE'); // Colonne pour LIBELLE_EXPL_DEPANNAGE
            $table->string('DIST_LIBELLE'); // Colonne pour DIST_LIBELLE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Centre_distrib');
    }
}
