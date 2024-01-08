<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\TransactionServiceInterface;
use App\Models\Order;

class SaveOrderService
{
    public function __construct(private TransactionServiceInterface $transactionService)
    {
    }

    public function __invoke(array $request): void
    {
        $this->transactionService->transactional(
            function () use ($request) {
                $selectedServices = $request['selected_services'];
                unset($request['selected_services']);
                $order = new Order($request);
                $order->save();
                $order->orderItems()->createMany([
                    ...$selectedServices
                ]);
            }
        );
    }
}
