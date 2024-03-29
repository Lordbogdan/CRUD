<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Order\Create\Input\CreateOrderDto;
use App\Entity\User;
use App\Service\Order\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class OrderCreateController extends AbstractController
{
    #[Route('/api/orders', name: 'app:orders-create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateOrderDto $dto,
        OrderServiceInterface               $service,
    ): Response {
        $user = $this->getUser();
        if ($user instanceof User) {
            try {
                $service->create($dto, $user);
            } catch (\Throwable $exception) {
                throw new BadRequestHttpException($exception->getMessage(), $exception);
            }
        }

        return $this->json([]);
    }
}
