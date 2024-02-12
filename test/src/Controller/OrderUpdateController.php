<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Order\Update\Input\UpdateOrderDto;
use App\Entity\User;
use App\Service\Order\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class OrderUpdateController extends AbstractController
{
    #[Route('/api/orders/{id}', name: 'app:orders-update', methods: ['PUT'])]
    public function update(
        #[MapRequestPayload] UpdateOrderDto $dto,
        string                              $id,
        OrderServiceInterface               $service,
    ): Response {
        $user = $this->getUser();
        if ($user instanceof User) {
            try {
                $service->update(Uuid::fromString($id), $dto);
            } catch (\Throwable $exception) {
                throw new BadRequestHttpException($exception->getMessage(), $exception);
            }
        }

        return $this->json([]);
    }
}
