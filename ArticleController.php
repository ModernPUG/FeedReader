<?php

namespace ModernPUG\FeedReader;

use Illuminate\Http\Request;

trait ArticleController
{
    public function index(IReader $reader, Request $request)
    {
        $tag = $request->input('tag');

        if($tag == null) $tag = 'php';

        $articles = $reader->recentUpdatedArticles($tag);

        if($tag) {
            $pagination = $articles->appends(['tag' => $tag])->render();
        } else {
            $pagination = $articles->render();
        }

        $data = [
            'articles' => $articles,
            'pagination' => $pagination,
            'tag' => $tag
        ];

        return view('allblog.articles', $data);
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
