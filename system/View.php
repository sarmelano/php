<?php

class View
{
    public function render(string $path, array $variables = []): bool
    {
        $filePath = VIEWS_DIR . $path . '.php';
        if(!file_exists($filePath)) {
            throw new Exception('View file not found: ' . $filePath);
        }

        if($variables) {
            extract($variables);
        }

        ob_start();
        require $filePath;
        echo ob_get_clean();

        return true;
    }
}