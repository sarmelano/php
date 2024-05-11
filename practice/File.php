<?php

class File {
    private string $path;

    public function __construct(string $path)
    {
        $this->setPath($path);
    }

//user interacting allowed
    public function setPath(string $path): void
    {
        $this->path = $path;
    }
    public function getPath(): string
    {
        return $this->path;
    }
//user interacting NOT allowed

    private function getExtension(string $path): string {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
}
