<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Annotation\Groups;

class DetailDTO
{
    #[Assert\Type('int')]
    #[Groups(["property:read"])]
    private mixed $id;

    #[Assert\Type('string')]
    #[Groups(["property:read"])]
    private string $address;

    #[Assert\Type('float')]
    #[Groups(["property:read"])]
    private float $price;

    #[Assert\Type('string')]
    #[Groups(["property:read"])]
    private string $source;

    public function getId(): mixed
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }
}
