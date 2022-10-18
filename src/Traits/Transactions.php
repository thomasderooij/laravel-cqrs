<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Traits;

use Illuminate\Support\Facades\DB;

trait Transactions
{
    protected function triggerTransactionStart(): void
    {
        if ($this->transaction) {
            DB::beginTransaction();
        }
    }

    protected function triggerTransactionCommit(): void
    {
        DB::commit();
    }

    protected function triggerTransactionRollback(): void
    {
        DB::rollBack();
    }
}