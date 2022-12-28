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
        $this->writeToFile(config('cqrs.query.directory'), __DIR__ . '/stubs/query.stub', [
            'queryNamespace' => $this->getQueryNamespace(),
            'queryClassName' => $this->getQueryClassName(),
        ]);
    }

    private function getQueryNamespace(): string
    {
        return config('app.namespace', 'App') . str_replace(
            "/",
            "\\",
            config('cqrs.query.directory')
        );
    }

    private function getQueryClassName(): string
    {
        return $this->argument('class');
    }
}