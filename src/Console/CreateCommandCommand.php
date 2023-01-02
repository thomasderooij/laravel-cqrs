<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class CreateCommandCommand extends Command
{
    use Writer;

    protected $signature = 'cqrs:command {class}';

    protected $description = 'Create a new CQRS command';

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle(): void
    {
        $this->writeToFile(
            $this->getDirectory() . '/'  . $this->argument('class'),
            $this->getStub(), [
            $this->getCommandNamespacePlaceholder() => $this->getCommandNamespace(),
            $this->getCommandClassNamePlaceholder() => $this->getCommandClassName(),
        ]);
    }

    protected function getDirectory(): string
    {
        return config('cqrs.command.directory');
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/command.stub';
    }

    protected function getCommandNamespacePlaceholder(): string
    {
        return '{commandNamespace}';
    }

    protected function getCommandNamespace(): string
    {
        return config('app.namespace', 'App\\') . str_replace(
                "/",
                "\\",
                config('cqrs.command.directory')
            );
    }

    protected function getCommandClassNamePlaceholder(): string
    {
        return '{commandClassName}';
    }

    protected function getCommandClassName(): string
    {
        return $this->argument('class');
    }
}