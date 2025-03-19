<?php

namespace App\Service\Api\Adapter;

use App\Service\Api\Port\ApiPort;

class BBCNewsApi implements ApiPort
{
    public function getApiResponse(): array
    {
        return [
          'id' => 1,
          'address' => 'bbc.com',
          'price' => 200,
          'source' => 'BBC News Description',
        ];
    }
}
