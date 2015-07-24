<?php

namespace ModernPUG\FeedReader;

use Illuminate\Database\Eloquent\Model;

class Viewcount extends Model
{
    protected $table = "viewcount";

    protected $fillable = ['article_id', 'ip'];

    public static function view(Article $article, $ip)
    {
        self::create([
            'article_id' => $article->id,
            'ip' => $ip,
        ]);

        return $article->link;
    }
}
