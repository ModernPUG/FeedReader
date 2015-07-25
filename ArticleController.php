<?php

namespace ModernPUG\FeedReader;

use Illuminate\Http\Request;

trait ArticleController
{
    public function index(IReader $reader)
    {
        $articles = $reader->recentUpdatedArticles();
        $blogs = $reader->blogs();

        return view('allblog.articles', compact('articles', 'blogs'));
    }

    public function show(IReader $reader, Request $request, $article_id)
    {
        $article = Article::find($article_id);
        $redirectUrl = $reader->viewArticle($article, $request->ip());

        return redirect($redirectUrl);
    }

    public function bestLastWeek(IReader $reader)
    {
        $articles = $reader->getLastBestArticles(7);
        return view('allblog.best', compact('articles'));
    }
}
