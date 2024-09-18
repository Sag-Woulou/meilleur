<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateServiceIdInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Mise à jour des lignes existantes avec une valeur aléatoire de 1 ou 2 comme service_id
        DB::statement('UPDATE tickets SET service_id = FLOOR(1 + RAND() * 2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionnel : remettre à null les valeurs de service_id
        DB::table('tickets')->update(['service_id' => null]);
    }
}
