<?php

namespace App;


use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use UuidModelTrait;

    public $validation = [
        'subtitle' => ['required'],
        'content' => ['required'],
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subtitle',
        'content',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Get the article that owns the page.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}