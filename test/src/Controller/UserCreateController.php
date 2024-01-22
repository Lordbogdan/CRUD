<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\User\Input\CreateOrUpdateUserDto;
use App\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserCreateController extends AbstractController
{
    #[Route('/users', name: 'app:user-create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateOrUpdateUserDto $createDto,
        UserServiceInterface                       $service,
    ): Response
    {
        $user = $service->create($createDto);

        return $this->json($user);
    }
}
