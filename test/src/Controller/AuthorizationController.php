<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Security\Registration\RegistrationDto;
use App\Repository\Interfaces\UserRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationController extends AbstractController
{
    #[Route('/authorization', name: 'app:user-auth', methods: ['POST'])]
    public function authorization(
        #[MapRequestPayload] RegistrationDto $dto,
        JWTTokenManagerInterface $jwtManager,
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {

        $user = $userRepository->getByPhone($dto->phone);

        if (!isset($user)) {
            throw new \Exception();
        }

        if (!$passwordHasher->isPasswordValid($user, $dto->password)) {
            throw new \Exception();
        }

        return $this->json(['token' => $jwtManager->create($user)]);
    }
}
