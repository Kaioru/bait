<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * Get the team's articles.
     */
    public function articles()
    {
        return $this->morphMany(Article::class, 'publisher');
    }

    /**
     * Get the team's leader.
     */
    public function leader()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the team's users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}