<?php

namespace ModernPUG\FeedReader;

interface IReader
{
    public function getLastError();
    public function getCreateViewName();
    public function recentUpdatedArticles($tag);
    public function viewArticle(Article $article, $ip);
    public function blogs();
    public function insertFeed($args);
    public function updateAllblogs();
    public function updateBlog($blog);
    public function getLastBestArticles($lastDays);
}
