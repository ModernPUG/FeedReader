<?php

namespace ModernPUG\FeedReader;

trait ArticleController
{
    public function index(IReader $reader)
    {
        $articles = $reader->recentUpdatedArticles();
        $blogs = $reader->blogs();

        return view('allblog.articles', compact('articles', 'blogs'));
    }
}
