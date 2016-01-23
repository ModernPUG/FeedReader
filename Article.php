<?php

namespace ModernPUG\FeedReader;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'published_at',
        'blog_id',
    ];

    public function blog()
    {
        return $this->belongsTo('ModernPUG\FeedReader\Blog');
    }

    public function tags()
    {
        return $this->belongsToMany('ModernPUG\FeedReader\Tag')->withTimestamps();
    }

    public function hasTag(array $tags)
    {
        $tagCollection = $this->tags;
        foreach($tagCollection as $tag) {
            if(in_array($tag['name'], $tags)) {
                return true;
            }
        }

        return false;
    }
}
