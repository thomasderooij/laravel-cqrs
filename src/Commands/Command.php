<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Commands;

use App\Models\User;
use Thomasderooij\Cqrs\Commands\Command as BaseCommand;
use Thomasderooij\LaravelCqrs\Traits\Transactions;

abstract class Command extends BaseCommand
{
    use Transactions;

    protected readonly ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }
}