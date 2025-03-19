<?php

namespace App\Service\Api\Application;

use App\DTO\DetailDTO;
use App\DTO\PropertiesDTO;
use App\Service\Api\Port\ApiPort;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiService
{
    private iterable $apiServices;
    public function __construct(
        #[TaggedIterator('app.api')] iterable $apiServices,
        private ValidatorInterface $validator
    ) {
        $this->apiServices = $apiServices;
    }

    /**
     * @throws \Exception
     */
    public function getApiResult(): ?PropertiesDTO
    {
        $propertiesDTO = new PropertiesDTO();
        $propertiesDTO->setName('lists');

        /** @var ApiPort $apiService */
        foreach ($this->apiServices as $apiService) {
           $detailDTO = new DetailDTO();
           $response = $apiService->getApiResponse();

           $detailDTO->setId($response['id']);
           $detailDTO->setAddress($response['address']);
           $detailDTO->setPrice($response['price']);
           $detailDTO->setSource($response['source']);

            $errors = $this->validator->validate($detailDTO);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return throw new \Exception($errorsString);
            }

            $propertiesDTO->addDetail($detailDTO);
        }

        return $propertiesDTO;
    }
}
