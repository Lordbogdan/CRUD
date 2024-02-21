<?php

declare(strict_types=1);

namespace unit;

use App\Dto\User\Input\CreateOrUpdateUserDto;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\User\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    public function testRemoveUser(): void
    {
        $userRepository = $this->createMock(UserRepository::class);

        $userRepository->expects($this->once())->method('remove');

        $userService = new UserService($userRepository);

        $userService->remove('test');
    }

    public function testUpdateUserSuccess(): void
    {
        $userRepository = $this->createMock(UserRepository::class);

        $user = new User();

        $userRepository->method('getById')->willReturn($user);

        $name = 'test';
        $email = 'test@mail.ru';
        $date = new \DateTime();
        $sex = 1;
        $age = 14;
        $phone =  '89374655784';

        $dto = new CreateOrUpdateUserDto($name, $email, $date, $sex, $age, $phone);

        $userService = new UserService($userRepository);

        $userService->update($dto, 'test');

        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($date->format('Ymd'), $user->getBirthday()->format('Ymd'));
        $this->assertEquals($sex, $user->getSex());
        $this->assertEquals($age, $user->getAge());
        $this->assertEquals($phone, $user->getPhone());
    }

    public function testUpdateUserNotFound(): void
    {
        $userRepository = $this->createMock(UserRepository::class);

        $userRepository->method('getById')->willReturn(null);

        $name = 'test';
        $email = 'test@mail.ru';
        $date = new \DateTime();
        $sex = 1;
        $age = 14;
        $phone =  '89374655784';

        $dto = new CreateOrUpdateUserDto($name, $email, $date, $sex, $age, $phone);

        $userService = new UserService($userRepository);

        $this->assertNull($userService->update($dto, 'test'));
    }

    public function testReadUser(): void
    {
        $userRepository = $this->createMock(UserRepository::class);

        $user = new User();

        $user->setName('Test');

        $userRepository->method('getById')->willReturn($user);

        $userService = new UserService($userRepository);

        $readUser = $userService->read('test');

        $this->assertEquals($user->getName(), $readUser->getName());
    }


}
