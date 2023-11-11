<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Eloquent\Transaction;

use Illuminate\Support\Facades\DB;
use App\Common\Application\TransactionServiceInterface;
use Throwable;

class TransactionService implements TransactionServiceInterface
{
    public function transactional(callable $func): void
    {
        DB::beginTransaction();

        try {
            call_user_func($func, $this);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();

            throw $e;
        }
    }
}
