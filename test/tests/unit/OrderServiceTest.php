<?php

declare(strict_types=1);

namespace unit;

use App\Dto\Order\Create\Input\CreateOrderDto;
use App\Dto\Order\Update\Input\UpdateOrderDto;
use App\Entity\Orders;
use App\Entity\User;
use App\Repository\OrdersRepository;
use App\Repository\UserRepository;
use App\Service\Order\OrderService;
use App\Service\User\UserService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class OrderServiceTest extends TestCase
{
    public function testCreateOrder(): void
    {
        $orderRepository = $this->createMock(OrdersRepository::class);

        $user = new User();

        $title = 'test';
        $description = 'test';
        $comment = 'test';
        $date  = new \DateTime();

        $dto = new CreateOrderDto($title, $description, $comment, $date);

        $orderService = new OrderService($orderRepository);

        $order = $orderService->create($dto, $user);

        $this->assertEquals($title, $order->getTitle());
        $this->assertEquals($description, $order->getDescription());
        $this->assertEquals($comment, $order->getComment());
        $this->assertEquals($date->format('Ymd'), $order->getDeadline()->format('Ymd'));
    }

    public function testUpdateOrder(): void
    {
        $orderRepository = $this->createMock(OrdersRepository::class);

        $order = new Orders();

        $orderRepository->method('getOrderById')->willReturn($order);

        $title = 'test';
        $description = 'test';
        $comment = 'test';
        $date  = new \DateTime();
        $status = true;

        $dto = new UpdateOrderDto($title, $description, $comment, $date, $status);

        $orderService = new OrderService($orderRepository);

        $orderService->update(Uuid::fromString('018d9c2c-115f-7e12-a269-fd026999fd04'), $dto);

        $this->assertEquals($title, $order->getTitle());
        $this->assertEquals($description, $order->getDescription());
        $this->assertEquals($comment, $order->getComment());
        $this->assertEquals($date->format('Ymd'), $order->getDeadline()->format('Ymd'));
        $this->assertEquals($status, $order->isStatus());
    }

    public function testRemoveOrder(): void
    {
        $orderRepository = $this->createMock(OrdersRepository::class);

        $orderRepository->expects($this->once())->method('remove');

        $userService = new OrderService($orderRepository);

        $userService->remove(Uuid::fromString('018d9c2c-115f-7e12-a269-fd026999fd04'));
    }
}
