<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Service\Order\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OrderReadController extends AbstractController
{
    #[Route('/api/orders/read', name: 'app:orders-read', methods: ['GET'])]
    public function read(
        OrderServiceInterface $service,
    ): Response {
        $user = $this->getUser();
        if ($user instanceof User) {
            try {
                $service->read($user);
            } catch (\Throwable $exception) {
                throw new BadRequestHttpException($exception->getMessage(), $exception);
            }
        }

        return $this->json([]);
    }
}
