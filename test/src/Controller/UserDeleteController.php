<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDeleteController extends AbstractController
{
    #[Route('/users/{id}', name: 'app:user-remove', methods: ['DELETE'])]
    public function remove(
        string               $id,
        UserServiceInterface $service,
    ): Response {
        $service->remove($id);

        return $this->json([]);
    }
}
