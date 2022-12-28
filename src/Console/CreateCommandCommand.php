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
        $this->writeToFile(config('cqrs.command.directory'), __DIR__ . '/stubs/command.stub', [
            'commandNamespace' => $this->getCommandNamespace(),
            'commandClassName' => $this->getCommandClassName(),
        ]);
    }

    private function getCommandNamespace(): string
    {
        return config('app.namespace', 'App') . str_replace(
                "/",
                "\\",
                config('cqrs.command.directory')
            );
    }

    private function getCommandClassName(): string
    {
        return $this->argument('class');
    }
}