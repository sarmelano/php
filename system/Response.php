<?php

class Response
{
    public static function redirect(string $url, ?int $code = 302): never
    {
        header('Location: ' . $url, $code);
        exit;
    }

    public static function error404(): never
    {
        header('NOT FOUND', true, 404);
        echo "<div>Oops, page not found!</div>";
        exit;
    }
}