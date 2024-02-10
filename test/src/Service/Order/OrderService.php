<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Orders;
use App\Entity\User;
use App\Repository\Interfaces\OrderRepositoryInterface;
use CreateOrderDto;
use Symfony\Component\Uid\Uuid;
use UpdateOrderDto;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        public readonly OrderRepositoryInterface $orderRepository,
    ) {
    }
    public function create(CreateOrderDto $dto, User $user): void
    {
        $order = new Orders();

        $order->setStatus(false);
        $order->setDescription($dto->description);
        $order->setTitle($dto->title);
        $order->setDeadline($dto->deadline);
        $order->setComment($dto->comment);
        $order->setUserField($user);

        $this->orderRepository->save($order);
    }

    public function read(User $user): ?array
    {
        $order = $this->orderRepository->getById($user->getId());

        return $order;
    }

    public function remove(Uuid $id): void
    {
        $this->orderRepository->remove($id);
    }

    public function update(Uuid $id, UpdateOrderDto $dto): ?Orders
    {
        $order = $this->orderRepository->getOrderById($id);

        $order->setComment($dto->comment);
        $order->setDescription($dto->description);
        $order->setTitle($dto->title);
        $order->setDeadline($dto->deadline);
        $order->setStatus($dto->status);

        $this->orderRepository->save($order);

        return $order;
    }
}
