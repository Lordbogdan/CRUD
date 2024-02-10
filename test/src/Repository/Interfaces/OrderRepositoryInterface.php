<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Entity\Orders;
use Symfony\Component\Uid\Uuid;

interface OrderRepositoryInterface
{
    public function save(Orders $order): void;

    public function remove(Uuid $id): void;

    public function getById(Uuid $id): ?array;

    public function getOrderById(Uuid $id): ?Orders;
}
