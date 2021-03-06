<?php

namespace ModernPUG\FeedReader;

use DB;
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

    public static function getLastBestArticles($lastDays)
    {
        $sql =<<<SQL
SELECT count(articles.id) AS vcount, articles.*
FROM viewcount
JOIN articles
ON articles.id = viewcount.article_id
WHERE viewcount.created_at >= DATE(NOW()) - INTERVAL ? DAY
GROUP BY articles.id
ORDER BY vcount DESC
LIMIT 20
SQL;
        $result = DB::select($sql, [$lastDays]);

        return Article::hydrate($result);
    }

    public static function getLastBestArticlesByTag($lastDays, $tagIds)
    {
        $tagCondition = '';
        if ($tagIds) {
            $tagIdsString = join(',', $tagIds);
            $tagCondition = " AND article_tag.tag_id IN ($tagIdsString) ";
        }

        $sql = <<<SQL
SELECT count(articles.id) AS vcount, articles.*
FROM viewcount
JOIN articles
ON articles.id = viewcount.article_id
JOIN article_tag
ON articles.id = article_tag.article_id
WHERE viewcount.created_at >= DATE(NOW()) - INTERVAL ? DAY
$tagCondition
GROUP BY articles.id
ORDER BY vcount DESC
LIMIT 20
SQL;
        $result = DB::select($sql, [$lastDays]);
        return Article::hydrate($result);
    }
}
