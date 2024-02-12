<?php

declare(strict_types=1);

namespace App\Dto\Order\Create\Input;

use Symfony\Component\Validator\Constraints as Assert;

class CreateOrderDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly ?string             $title,
        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly ?string             $description,
        #[Assert\NotBlank()]
        #[Assert\Length(min: 2, max: 100)]
        public readonly ?string             $comment,
        #[Assert\NotBlank()]
        public readonly ?\DateTimeInterface $deadline,
    ) {
    }

}
