<?php

declare(strict_types=1);

namespace App\Service\Security;

use App\Dto\Security\Registration\RegistrationDto;
use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService implements RegistrationServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }
    public function registration(RegistrationDto $dto): ?User
    {
        $user = new User();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $dto->password
        );

        $user->setPhone($dto->phone);
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user);

        return $user;
    }

}
