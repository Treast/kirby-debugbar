<?php

namespace Treast\KirbyDebugbar;

use Kirby\Cms\App;
use Kirby\Cms\Event;
use Kirby\Filesystem\F;

use DebugBar\DataCollector\ConfigCollector;
use DebugBar\DataCollector\ExceptionsCollector;
use DebugBar\DataCollector\MemoryCollector;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\PhpInfoCollector;
use DebugBar\DataCollector\RequestDataCollector;
use DebugBar\DebugBar as DebugBarDebugBar;
use Treast\KirbyDebugbar\DataCollector\EventCollector;
use Treast\KirbyDebugbar\DataCollector\FileCollector;
use Treast\KirbyDebugbar\DataCollector\PageCollector;

class Debugbar
{
    protected static DebugBarDebugBar $debugbar;
    protected static App $kirby;

    public static function init(App $kirby)
    {
        $config = F::load($kirby->root('config') . '/config.php');

        self::$debugbar = new DebugBarDebugBar();
        self::$debugbar->addCollector(new MessagesCollector());
        self::$debugbar->addCollector(new ConfigCollector($config));
        self::$debugbar->addCollector(new EventCollector());
        self::$debugbar->addCollector(new FileCollector());
        self::$debugbar->addCollector(new PhpInfoCollector());
        self::$debugbar->addCollector(new RequestDataCollector());
        self::$debugbar->addCollector(new MemoryCollector());
        self::$debugbar->addCollector(new ExceptionsCollector());
    }

    public static function getRenderer($baseUrl = null)
    {
        return self::$debugbar->getJavascriptRenderer($baseUrl);
    }

    public static function log($data, $label = 'info', $channel = 'messages')
    {
        self::$debugbar->getCollector($channel)->addMessage($data, $label);
    }

    public static function debug($data, $channel = 'messages')
    {
        self::log($data, 'debug', $channel);
    }

    public static function emergency($data, $channel = 'messages')
    {
        self::log($data, 'emergency', $channel);
    }

    public static function alert($data, $channel = 'messages')
    {
        self::log($data, 'alert', $channel);
    }

    public static function error($data, $channel = 'messages')
    {
        self::log($data, 'error', $channel);
    }

    public static function warning($data, $channel = 'messages')
    {
        self::log($data, 'warning', $channel);
    }

    public static function critical($data, $channel = 'messages')
    {
        self::log($data, 'critical', $channel);
    }

    public static function notice($data, $channel = 'messages')
    {
        self::log($data, 'notice', $channel);
    }

    public static function info($data, $channel = 'messages')
    {
        self::log($data, 'info', $channel);
    }

    public static function logEvent(Event $event)
    {
        self::log($event, 'info', 'events');
    }

    public static function logException(\Exception $e)
    {
        self::$debugbar->getCollector('exceptions')->addException($e);
    }

    public static function logFiles(string $type, array $files)
    {
        self::$debugbar->getCollector('files')->addFiles($type, $files);
    }

    public static function startPage($name, $label, $channel = 'pages')
    {
        self::$debugbar->getCollector($channel)->startMeasure($name, $label);
    }

    public static function stopPage($name, $channel = 'pages')
    {
        if (self::$debugbar->getCollector($channel)->hasStartedMeasure($name)) self::$debugbar->getCollector($channel)->stopMeasure($name);
    }
}
