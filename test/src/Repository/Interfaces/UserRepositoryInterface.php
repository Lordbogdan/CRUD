<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function remove(string $id): void;

    public function getById(string $id): ?User;
}
