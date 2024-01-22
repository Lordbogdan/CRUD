<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserReadController extends AbstractController
{
    #[Route('/users/{id}', name: 'app:user-get', methods: ['GET'])]
    public function read(
        string               $id,
        UserServiceInterface $service,
    ): Response
    {
        $user = $service->read($id);

        return $this->json($user);
    }
}
