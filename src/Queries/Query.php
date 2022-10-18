<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Queries;

use App\Models\User;
use Thomasderooij\Cqrs\Queries\Query as BaseQuery;
use Thomasderooij\LaravelCqrs\Traits\Transactions;

abstract class Query extends BaseQuery
{
    use Transactions;

    protected readonly ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }
}