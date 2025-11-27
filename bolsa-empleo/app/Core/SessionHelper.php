<?php
// app/Core/SessionHelper.php

namespace App\Core;

class SessionHelper
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function setFlash(string $key, string $message): void
    {
        self::set("flash_{$key}", $message);
    }

    public static function getFlash(string $key): ?string
    {
        self::start();
        $flashKey = "flash_{$key}";
        
        $message = $_SESSION[$flashKey] ?? null;
        if ($message !== null) {
            unset($_SESSION[$flashKey]);
        }
        return $message;
    }

    public static function destroy(): void
    {
        self::start();
        session_unset();
        session_destroy();
    }
}