<?php

declare(strict_types=1);

namespace unit;

use App\Dto\Security\Registration\RegistrationDto;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Security\RegistrationService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class RegistrationServiceTest extends TestCase
{
    public function testRegistrationUser(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $passwordHasher = $this->createMock(UserPasswordHasher::class);

        $user = new User();

        $user->setPhone('test');

        $dto = new RegistrationDto('test', 'test');

        $userService = new RegistrationService($userRepository, $passwordHasher);

        $userService->registration($dto);

        $this->assertEquals($dto->phone, $user->getPhone());
    }
}
