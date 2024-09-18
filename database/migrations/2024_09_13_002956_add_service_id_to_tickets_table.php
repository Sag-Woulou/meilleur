<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceIdToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Ajout de la colonne service_id
            $table->unsignedBigInteger('service_id')->nullable()->after('NumeroContact2');

            // Ajout de la contrainte de clé étrangère avec la table 'services'
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Suppression de la clé étrangère et de la colonne
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
}
