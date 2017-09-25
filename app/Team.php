<?php

namespace App;


use App\Transformers\ArticleTeamTransformer;
use App\Transformers\TeamTransformer;
use League\Fractal\TransformerAbstract;

class Team extends Publisher
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

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        return new TeamTransformer();
    }

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function parentTransformer(): TransformerAbstract
    {
        return new ArticleTeamTransformer();
    }
}