<?php

namespace App\Dto\Order;

class InputOrderDto
{
    public function __construct(
        public readonly ?int $page,
        public readonly ?int $sort,
    ) {
    }

}
