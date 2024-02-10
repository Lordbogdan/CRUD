<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Dto\User\Input\CreateOrUpdateUserDto;
use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function remove(string $id): void
    {
        $this->userRepository->remove($id);
    }

    public function update(CreateOrUpdateUserDto $dto, string $id): ?User
    {
        $user = $this->userRepository->getById($id);

        if (null === $user) {
            return null;
        }

        return $this->setUserData($user, $dto);
    }

    public function setUserData(User $user, CreateOrUpdateUserDto $dto): ?User
    {
        $user->setEmail($dto->email);
        $user->setName($dto->name);
        $user->setAge($dto->age);
        $user->setPhone($dto->phone);
        $user->setBirthday($dto->birthDate);
        $user->setSex($dto->sex);
        //$user->setPassword($dto->password);

        $this->userRepository->save($user);

        return $user;
    }

    public function read(string $id): ?User
    {
        $user = $this->userRepository->getById($id);

        return $user;
    }
}
