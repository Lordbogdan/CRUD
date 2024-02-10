<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Security\Registration\RegistrationDto;
use App\Service\Security\RegistrationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app:user-registration', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] RegistrationDto $dto,
        RegistrationServiceInterface $service,
    ): Response {
        $user = $service->registration($dto);

        return $this->json($user);
    }
}
