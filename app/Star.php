<?php

namespace App;


use App\Transformers\StarTransformer;
use League\Fractal\TransformerAbstract;

class Star extends Model
{
    protected $fillable = [
        'article_id',
    ];

    public $validation = [
        'article_id' => ['required'],
    ];

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        return new StarTransformer();
    }

    /**
     * Get the star's article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the star's user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}