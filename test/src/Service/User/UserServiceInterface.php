<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Dto\User\Input\CreateOrUpdateUserDto;
use App\Entity\User;

interface UserServiceInterface
{
    public function remove(string $id): void;

    public function update(CreateOrUpdateUserDto $dto, string $id): ?User;

    public function read(string $id): ?User;
}
