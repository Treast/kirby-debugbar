<?php

namespace Treast\KirbyDebugbar;

class Logger implements LoggerInterface
{
    const DEFAULT_CHANNEL = 'logs';

    public static function debug(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'debug', $channel);
    }

    public static function emergency(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'emergency', $channel);
    }

    public static function alert(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'alert', $channel);
    }

    public static function error(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'error', $channel);
    }

    public static function critical(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'critical', $channel);
    }

    public static function info(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'info', $channel);
    }

    public static function warning(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'warning', $channel);
    }

    public static function notice(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'notice', $channel);
    }

    public static function log(string $level, mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, $level, $channel);
    }
}
