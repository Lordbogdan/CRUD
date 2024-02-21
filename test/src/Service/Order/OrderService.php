<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Dto\Order\Create\Input\CreateOrderDto;
use App\Dto\Order\Update\Input\UpdateOrderDto;
use App\Entity\Orders;
use App\Entity\User;
use App\Repository\Interfaces\OrderRepositoryInterface;
use Symfony\Component\Uid\Uuid;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        public readonly OrderRepositoryInterface $orderRepository,
    ) {
    }
    public function create(CreateOrderDto $dto, User $user): Orders
    {
        $order = new Orders();

        $order->setStatus(false);
        $order->setDescription($dto->description);
        $order->setTitle($dto->title);
        $order->setDeadline($dto->deadline);
        $order->setComment($dto->comment);
        $order->setUserField($user);

        $this->orderRepository->save($order);

        return $order;
    }

    public function read(User $user, int $page, int $sort): array
    {

        $orders = $this->orderRepository->getPaginatorByUserId($user->getId(), $page, $sort);

        $response = [];

        foreach ($orders as $order) {
            $response[] = [
                'id' => $order->getId(),
                'title' => $order->getTitle(),
                'description' => $order->getDescription(),
                'deadline' => $order->getDeadline(),
                'status' => $order->isStatus(),
                'created_at' => $order->getCreatedAt(),
            ];
        }

        return $response;
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
