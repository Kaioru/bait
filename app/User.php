<?php

namespace App;

use Alsofronie\Uuid\UuidModelTrait;
use App\Transformers\ArticleUserTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use League\Fractal\TransformerAbstract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Publisher implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, UuidModelTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public $validation = [
        'username' => ['required'],
        'email' => ['required'],
        'password' => ['required'],
    ];

    /**
     * Get the user's articles.
     */
    public function articles()
    {
        return $this->morphMany(Article::class, 'publisher');
    }

    /**
     * Get the user's stars.
     */
    public function stars()
    {
        return $this->hasMany(Star::class);
    }

    /**
     * Get the user's owned teams.
     */
    public function ownedTeams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get the user's teams.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        return new UserTransformer();
    }

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function parentTransformer(): TransformerAbstract
    {
        return new ArticleUserTransformer();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}