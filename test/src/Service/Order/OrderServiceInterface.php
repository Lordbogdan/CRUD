<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Dto\Order\Create\Input\CreateOrderDto;
use App\Dto\Order\Update\Input\UpdateOrderDto;
use App\Entity\Orders;
use App\Entity\User;
use Symfony\Component\Uid\Uuid;

interface OrderServiceInterface
{
    public function create(CreateOrderDto $dto, User $user): void;

    public function read(User $user, int $page, int $sort): array;

    public function remove(Uuid $id): void;

    public function update(Uuid $id, UpdateOrderDto $dto): ?Orders;

}
