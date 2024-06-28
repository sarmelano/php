<?php


class Session
{
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public static function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public static function removeValidationError(string $key)
    {
        unset($_SESSION['validationErrors'][$key]);
    }
}