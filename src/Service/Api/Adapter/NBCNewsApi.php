<?php

namespace App\Service\Api\Adapter;

use App\Service\Api\Port\ApiPort;

class NBCNewsApi implements ApiPort
{
    public function getApiResponse(): array
    {
        return [
          'id' => 2,
          'address' => 'nbc.com',
          'price' => 300,
          'source' => 'NBC News Description',
        ];
    }
}
