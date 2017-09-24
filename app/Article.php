<?php

namespace App;

use App\Transformers\ArticleTransformer;
use League\Fractal\TransformerAbstract;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'body',
        'unlisted',
    ];

    public $validation = [
        'title' => ['required'],
        'body' => ['required'],
        'unlisted' => ['required'],
    ];

    /**
     * Get the article's publisher.
     */
    public function publisher()
    {
        return $this->morphTo();
    }

    /**
     * Get the article's pages.
     */
    public function pages()
    {
        $this->hasMany(Page::class);
    }

    /**
     * Get the transformer for the model.
     *
     * @return TransformerAbstract
     */
    function transformer(): TransformerAbstract
    {
        return new ArticleTransformer();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}