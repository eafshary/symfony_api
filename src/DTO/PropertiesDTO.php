<?php

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class PropertiesDTO
{
    #[Groups(["property:read"])]
    private string $name;

    #[Groups(["property:read"])]
    private array $details;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addDetail(DetailDTO $detail): void
    {
        $this->details[] = $detail;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
