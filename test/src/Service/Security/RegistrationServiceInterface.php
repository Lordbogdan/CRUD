<?php

declare(strict_types=1);

namespace App\Service\Security;

use App\Dto\Security\Registration\RegistrationDto;
use App\Entity\User;

interface RegistrationServiceInterface
{
    public function registration(RegistrationDto $dto): ?User;
}
