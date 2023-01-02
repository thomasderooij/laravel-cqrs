<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateQueryCommand extends Command
{
    use Writer;

    protected $signature = 'cqrs:query {class}';

    protected $description = 'Create a new CQRS query';

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle(): void
    {
        $this->writeToFile(
            $this->getDirectory() . '/' . $this->argument('class'),
            $this->getStub(), [
            $this->getQueryNamespacePlaceholder() => $this->getQueryNamespace(),
            $this->getQueryClassNamePlaceholder() => $this->getQueryClassName(),
        ]);
    }

    protected function getDirectory(): string
    {
        return config('cqrs.query.directory');
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/query.stub';
    }

    protected function getQueryNamespacePlaceholder(): string
    {
        return '{commandNamespace}';
    }

    protected function getQueryNamespace(): string
    {
        return config('app.namespace', 'App\\') . str_replace(
            "/",
            "\\",
            config('cqrs.query.directory')
        );
    }

    protected function getQueryClassNamePlaceholder(): string
    {
        return '{commandClassName}';
    }

    protected function getQueryClassName(): string
    {
        return $this->argument('class');
    }
}