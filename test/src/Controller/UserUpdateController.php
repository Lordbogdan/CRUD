<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\User\Input\CreateOrUpdateUserDto;
use App\Service\User\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateController extends AbstractController
{
    #[Route('/users/{id}', name: 'app:user-update', methods: ['PUT'])]
    public function update(
        #[MapRequestPayload] CreateOrUpdateUserDto $createDto,
        string                                     $id,
        UserServiceInterface                       $service,
    ): Response {
        $user = $service->update($createDto, $id);

        return $this->json($user);
    }
}
