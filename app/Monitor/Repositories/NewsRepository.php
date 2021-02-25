<?php

namespace App\Monitor\Repositories;

use KubAT\PhpSimple\HtmlDomParser;
use App\{News};

class NewsRepository
{
    public function downloadNews($url, $element)
    {
        $news = HtmlDomParser::file_get_html($url)->find($element);

        $unique_news = array_unique($news);
        return $unique_news;
    }

    public function saveNews($news, $website_id)
    {
        News::create([
            'content' => $news,
            'status' => 'unread',
            'website_id' => $website_id,
            'created_at' => new \DateTime(),
        ]);
    }

    public function sortNewsByUnreaded($news)
    {
        $unredNews = array();
        foreach ($news as $key => $row) {
            $unredNews[$key] = $row['unread'];
        }
        return $unredNews;
    }
}