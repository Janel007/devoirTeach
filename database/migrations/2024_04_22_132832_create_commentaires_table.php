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
        Schema::create('commentaires', function (Blueprint $table) { //Le callback function (Blueprint $table) { ... } permet de définir le schéma de la table.
            $table->id(); //Crée une colonne id de type entier auto-incrémenté, qui sera utilisée comme clé primaire.

            $table->longText('comment'); //Crée une colonne comment de type longText pour stocker le texte du commentaire.

            $table->foreignId('user_id')
                ->constrained() //indique que cette clé étrangère fait référence à la table users.
                ->onUpdate('cascade') //signifie que si l'identifiant de l'utilisateur est modifié, la valeur sera mise à jour dans la table commentaires.
                ->onDelete('cascade'); //signifie que si l'utilisateur est supprimé, les commentaires associés seront également supprimés.

            $table->foreignId('article_id') //Crée une colonne article_id de type entier qui sera une clé étrangère.
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps(); //Ajoute les colonnes created_at et updated_at pour enregistrer les dates de création et de mise à jour des commentaires.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
