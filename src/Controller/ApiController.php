<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\Api\Application\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use Nelmio\ApiDocBundle\Attribute\Security;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class ApiController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly SerializerInterface $serializer,
        private readonly ApiService $apiService,
        private readonly CacheInterface $cache // Inject the cache interface
    ) {
    }

    #[Route('/api/properties', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns properties',
    )]
    #[Security(name: 'Bearer')]
    public function properties(): JsonResponse
    {
        try {
            $cacheKey = 'api_properties';
            $json = $this->cache->get($cacheKey, function (ItemInterface $item) {
                // Cache TTL (Time-To-Live) in seconds
                $item->expiresAfter(3600); // Cache for 1 hour

                // Fetch data from API Service
                $apiResult = $this->apiService->getApiResult();

                // Serialize the response
                return $this->serializer->serialize($apiResult, 'json', ['groups' => 'property:read']);
            });

        } catch (\Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], 500);
        }

        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/api/users', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns users',
    )]
    public function users(): JsonResponse
    {
        $users = $this->userRepository->findAll();
        $json = $this->serializer->serialize($users, 'json', ['groups' => 'user:read']);

        return new JsonResponse($json, 200, [], true);
    }
}
