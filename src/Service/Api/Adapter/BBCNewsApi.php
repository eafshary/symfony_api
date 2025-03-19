<?php

namespace App\Service\Api\Adapter;

use App\Service\Api\Port\ApiPort;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class BBCNewsApi implements ApiPort
{
    private string $dataPath;

    public function __construct(string $dataPath, private CacheInterface $cache)
    {
        $this->dataPath = realpath($dataPath);
    }

    public function getApiResponse(): array
    {
        $cacheKey = 'bbc_news_api_response';
        $filePath = $this->dataPath . '/bbc_news.json';

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($filePath) {
            $item->expiresAfter(3600);

            if (!file_exists($filePath)) {
               return [];
            }

            $jsonData = file_get_contents($filePath);
            return json_decode($jsonData, true);
        });
    }
}
