<?php

namespace App;


use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use UuidModelTrait, HasSlug;

    public $validation = [
        'title' => ['required'],
        'content' => ['required'],
        'unlisted' => ['required'],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'unlisted',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Get the pages for the article.
     */
    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    /**
     * Get the user that owns the article.
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}