<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Order\InputOrderDto;
use App\Entity\Orders;
use App\Entity\User;
use App\Service\Order\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class OrderReadController extends AbstractController
{
    #[Route('/api/orders', name: 'app:orders-read', methods: ['GET'])]
    public function read(
        #[MapQueryParameter] int $page,
        #[MapQueryParameter] int $sort,
        OrderServiceInterface $service,
    ): JsonResponse {
        /** @var User $user */
        $user = $this->getUser();
        try {
            /** @var Orders[] $orders */
            $orders = $service->read($user, $page, $sort);

            return $this->json(['orders'=> $orders]);
        } catch (\Throwable $exception) {
            throw new BadRequestHttpException($exception->getMessage(), $exception);
        }
    }
}
