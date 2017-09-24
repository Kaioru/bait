<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * Get the page's article.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}