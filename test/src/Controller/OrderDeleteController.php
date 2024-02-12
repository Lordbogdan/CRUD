<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Service\Order\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class OrderDeleteController extends AbstractController
{
    #[Route('/api/order/{id}', name: 'app:orders-remove', methods: ['DELETE'])]
    public function remove(
        string $id,
        OrderServiceInterface $service,
    ): Response {
        $user = $this->getUser();
        if ($user instanceof User) {
            try {
                $service->remove(Uuid::fromString($id));
            } catch (\Throwable $exception) {
                throw new BadRequestHttpException($exception->getMessage(), $exception);
            }
        }

        return $this->json([]);
    }
}
