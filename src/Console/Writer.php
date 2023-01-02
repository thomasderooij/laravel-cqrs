<?php

declare(strict_types=1);

namespace Thomasderooij\LaravelCqrs\Console;

trait Writer
{
    public function writeToFile(string $filename, string $stub, array $placeholderData): void
    {
        $parts = explode('/', $filename);
        $classname = array_pop($parts);

        $dir = implode( '/', $parts);
        if (!$this->files->exists(app_path($dir))) {
            $this->files->makeDirectory(app_path($dir), 755, true);
        }

        $content = $this->files->get($stub);
        foreach ($placeholderData as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        $location = app_path($dir) . '/' . $classname . '.php';
        $this->files->put($location, $content);
    }
}