<?php

namespace ModernPUG\FeedReader;

use Illuminate\Http\Request;

trait BlogController
{
    public function index(IReader $reader)
    {
        $blogs = $reader->blogs();

        return view('allblog.blog_index', compact('blogs'));
    }

    public function create(IReader $reader)
    {
        return view($reader->getCreateViewName());
    }

    public function store(IReader $reader, Request $request)
    {
        $redirect = redirect('/blog');

        if (!$reader->insertFeed($request->all())) {
            $redirect->with('message', $reader->getLastError());
        }

        return $redirect;
    }
}