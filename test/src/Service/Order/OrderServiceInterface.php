<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Orders;
use App\Entity\User;
use CreateOrderDto;
use Symfony\Component\Uid\Uuid;
use UpdateOrderDto;

interface OrderServiceInterface
{
    public function create(CreateOrderDto $dto, User $user): void;

    public function read(User $user): ?array;

    public function remove(Uuid $id): void;

    public function update(Uuid $id, UpdateOrderDto $dto): ?Orders;

}
