<?php

namespace App\Service\Api\Adapter;

use App\Service\Api\Port\ApiPort;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

abstract class AbstractNewsApi implements ApiPort
{
    private string $dataPath;

    public function __construct(string $dataPath, protected CacheInterface $cache)
    {
        $this->dataPath = realpath($dataPath);
    }

    abstract protected function getFileName(): string;

    abstract protected function getCacheKey(): string;

    public function getApiResponse(): array
    {
        $cacheKey = $this->getCacheKey();
        $filePath = $this->dataPath . '/' . $this->getFileName();

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
