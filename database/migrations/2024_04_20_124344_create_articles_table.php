<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('nomArticle');
            $table->string('imageArticle');
            $table->string('descArticle');

            $table->foreignId('user_id') // Cela crée une colonne user_id qui est une clé étrangère.
                ->constrained() // Cela indique que la colonne user_id fait référence à la colonne id de la table users par défaut.
                ->onUpdate('cascade') // Cela indique que la colonne user_id fait référence à la colonne id de la table users par défaut.
                ->onDelete('cascade'); // Cela définit le comportement de suppression en cascade, ce qui signifie que si un utilisateur est supprimé de la table users, tous les enregistrements associés dans cette table seront également supprimés.
            
        /*  $table->foreign('user_id') // Cela spécifie que la colonne user_id est une clé étrangère.
                ->references('id')// Cela indique que la colonne user_id fait référence à la colonne id dans une autre table.
                ->on('users') // Cela spécifie que la table référencée est users.
                ->onDelete('cascade'); 
        */    
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
