<?php

declare(strict_types=1);

namespace App\Dto\Security\Registration;

use Symfony\Component\Validator\Constraints as Assert;

class RegistrationDto
{
    public function __construct(
        #[Assert\NotBlank()]
        public readonly ?string $phone,
        #[Assert\NotBlank()]
        #[Assert\Length(min: 8)]
        public readonly ?string $password,
    ) {
    }
}
