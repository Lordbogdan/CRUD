<?php

declare(strict_types=1);

namespace App\Dto\User\Input;

use Symfony\Component\Validator\Constraints as Assert;
class CreateOrUpdateUserDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly string $name,

        #[Assert\Email]
        #[Assert\Length(min: 5, max: 100)]
        public readonly ?string $email,

        public readonly ?\DateTimeInterface $birthDate,

        #[Assert\Range(min: 1, max: 2)]
        public readonly ?int $sex,

        #[Assert\Range(min: 0, max: 120)]
        public readonly ?int $age,

        #[Assert\Regex(pattern:"/^(\+7|8)?[ -]?(\(\d{3}\)|\d{3})[ -]?\d{3}[ -]?\d{2}[ -]?\d{2}$/")]
        public readonly ?string $phone,
    ){}
}
