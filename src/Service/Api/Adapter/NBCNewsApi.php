<?php

namespace App\Service\Api\Adapter;

class NBCNewsApi extends AbstractNewsApi
{
    protected function getFileName(): string
    {
        return 'nbc_news.json';
    }

    protected function getCacheKey(): string
    {
        return 'nbc_news_api_response';
    }
}
