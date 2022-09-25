<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_name')->unique();// nom de l'entreprise
            $table->string('type');//type de commerce
            $table->longText('description');
            $table->string('store_id')->unique();//id de reference
            $table->string('location');
            $table->string('adress');
            $table->string('country');
            $table->string('town');
            $table->string('quarter');
            $table->string('street');
            $table->string('user_code');//numero de piece d'identité
            $table->integer('phone_code');
            $table->integer('phone');
            $table->string('founder_name');// nom du fondateur
            $table->integer('capital_price');//capital de l'entreprise Ex : 10.000.000 Fcfa
            $table->string('email')->index();
            $table->integer('code_postal');
            $table->string('images');
            $table->string('transaction');
            $table->integer('postal_code');
            $table->string('web_site');
            $table->string('social_links');
            $table->string('statut');//statut de l'entreprise ex: SARL
            $table->string('rating');//notes en etoile 
            $table->longText('story');//historique de l'entreprise
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
