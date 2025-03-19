<?php

namespace App\Service\Api\Adapter;

class BBCNewsApi extends AbstractNewsApi
{
    protected function getFileName(): string
    {
        return 'bbc_news.json';
    }

    protected function getCacheKey(): string
    {
        return 'bbc_news_api_response';
    }
}
