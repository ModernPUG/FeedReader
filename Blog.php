<?php

namespace ModernPUG\FeedReader;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'feed_url', 'site_url',
    ];
}
