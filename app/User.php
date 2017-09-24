<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * Get the user's articles.
     */
    public function articles()
    {
        return $this->morphMany(Article::class, 'publisher');
    }

    /**
     * Get the user's owned teams.
     */
    public function ownedTeams() {
        return $this->hasMany(Team::class);
    }

    /**
     * Get the user's teams.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}