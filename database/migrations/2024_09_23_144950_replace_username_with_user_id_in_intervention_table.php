<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ReplaceUsernameWithUserIdInInterventionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intervention', function (Blueprint $table) {
            // Ajoutez d'abord la nouvelle colonne user_id
            $table->unsignedBigInteger('user_id')->nullable();
        });

        // Mettez à jour les enregistrements existants avec des valeurs aléatoires
        DB::table('intervention')->update(['user_id' => rand(1, 2)]);

        // Ensuite, supprimez la colonne UserName
        Schema::table('intervention', function (Blueprint $table) {
            $table->dropColumn('UserName');
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
            // Restaurez la colonne UserName
            $table->string('UserName')->nullable();

            // Supprimez la colonne user_id
            $table->dropColumn('user_id');
        });
    }
}
