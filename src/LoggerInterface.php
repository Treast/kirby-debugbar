<?php

namespace Treast\KirbyDebugbar;

interface LoggerInterface
{
    /**
     * System is unusable.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function emergency(mixed $data, string $channel);

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function alert(mixed $data, string $channel);

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function critical(mixed $data, string $channel);

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function error(mixed $data, string $channel);

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function warning(mixed $data, string $channel);

    /**
     * Normal but significant events.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function notice(mixed $data, string $channel);

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function info(mixed $data, string $channel);

    /**
     * Detailed debug information.
     *
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function debug(mixed $data, string $channel);

    /**
     * Logs with an arbitrary level.
     *
     * @param string $level
     * @param mixed $data
     * @param string $channel
     * @return void
     */
    public static function log(string $level, mixed $data, string $channel);
}
