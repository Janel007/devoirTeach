<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory; // Cette ligne inclut le trait HasFactory fourni par Laravel, qui ajoute des méthodes utiles pour la création de modèles.
    protected $fillable = [ /*Cette propriété indique les champs qui peuvent être remplis de manière massive (mass-assignable) lors de la création ou de la mise à jour d'un commentaire.
    Dans ce cas, les champs comment, user_id et article_id peuvent être remplis de cette manière. */
        'comment',
        'user_id',
        'article_id',
    ];

    public function articles() /* Cette méthode définit une relation "appartient à" (belongsTo) entre le modèle Commentaire et le modèle Article.
    Le premier argument Article::class indique le modèle avec lequel la relation est établie.
    Le deuxième argument 'user_id' indique que la clé étrangère user_id dans la table commentaires fait référence à l'id de la table articles. */
    {
        return $this->belongsTo(Article::class, 'user_id');
    }

    public function user() /*Cette méthode définit une relation "appartient à" (belongsTo) entre le modèle Commentaire et le modèle User.
    Le premier argument User::class indique le modèle avec lequel la relation est établie.
    Le deuxième argument 'user_id' indique que la clé étrangère user_id dans la table commentaires fait référence à l'id de la table users. */
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
