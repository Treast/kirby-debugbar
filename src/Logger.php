<?php

namespace Treast\KirbyDebugbar;

class Logger implements LoggerInterface
{
    const DEFAULT_CHANNEL = 'logs';

    public function debug(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'debug', $channel);
    }

    public function emergency(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'emergency', $channel);
    }

    public function alert(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'alert', $channel);
    }

    public function error(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'error', $channel);
    }

    public function critical(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'critical', $channel);
    }

    public function info(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'info', $channel);
    }

    public function warning(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'warning', $channel);
    }

    public function notice(mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, 'notice', $channel);
    }

    public function log(string $level, mixed $data, string $channel = self::DEFAULT_CHANNEL)
    {
        Debugbar::log($data, $level, $channel);
    }
}
