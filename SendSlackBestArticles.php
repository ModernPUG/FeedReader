<?php

namespace ModernPUG\FeedReader;

use Illuminate\Console\Command;

class SendSlackBestArticles extends Command
{
    protected $name = 'send:slack:best';

    protected $description = 'Slack�� �α���� ������';

    public function fire(IReader $reader)
    {
        $articles = $reader->getLastBestArticles(7);
        $rank = 1;
        $output = '';
        foreach ( $articles as $article ) {
            $url = url("article/{$article->id}");
            $title = $article->title;
            $output .= "$rank. $title ( $url )\r\n";
            $rank++;
        }
        Slack::send($output);
    }
}
