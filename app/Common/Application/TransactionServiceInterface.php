<?php

declare(strict_types=1);

namespace App\Common\Application;

interface TransactionServiceInterface
{
    public function transactional(callable $func): void;
}
