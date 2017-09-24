<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
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
    public function pages() {
        $this->hasMany(Page::class);
    }
}