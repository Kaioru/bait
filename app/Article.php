<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
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

    public $validation = [
        'title' => ['required'],
        'content' => ['required'],
        'unlisted' => ['required'],
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
}