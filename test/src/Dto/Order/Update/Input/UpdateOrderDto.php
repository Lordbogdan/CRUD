<?php

declare(strict_types=1);

use Symfony\Component\Validator\Constraints as Assert;

class UpdateOrderDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly ?string $title,

        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly ?string $description,

        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly ?string $comment,

        #[Assert\NotBlank()]
        public readonly ?\DateTimeInterface $deadline,

        #[Assert\NotBlank()]
        public readonly ?bool $status,
    ) {
    }

}
