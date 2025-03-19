<?php

namespace App\Service\Api\Port;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.api')]
interface ApiPort
{
    public function getApiResponse(): array;
}
