<?php

namespace Treast\KirbyDebugbar;

use DebugBar\DataCollector\ConfigCollector;
use DebugBar\DataCollector\ExceptionsCollector;
use DebugBar\DataCollector\MemoryCollector;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\PhpInfoCollector;
use DebugBar\DataCollector\RequestDataCollector;
use DebugBar\DebugBar as DebugBarDebugBar;
use Treast\KirbyDebugbar\DataCollector\EventCollector;
use Treast\KirbyDebugbar\DataCollector\PageCollector;

class Debugbar
{
    protected static $debugbar;
    protected static $kirby;

    public static function init($kirby)
    {
        $config = \F::load($kirby->root('config') . '/config.php');

        self::$debugbar = new DebugBarDebugBar();
        self::$debugbar->addCollector(new MessagesCollector());
        self::$debugbar->addCollector(new ConfigCollector($config));
        self::$debugbar->addCollector(new EventCollector());
        self::$debugbar->addCollector(new PhpInfoCollector());
        self::$debugbar->addCollector(new RequestDataCollector());
        self::$debugbar->addCollector(new MemoryCollector());
        self::$debugbar->addCollector(new ExceptionsCollector());
    }

    public static function getRenderer($baseUrl = null)
    {
        return self::$debugbar->getJavascriptRenderer($baseUrl);
    }

    public static function logEvent($event)
    {
        self::log($event, 'info', 'events');
    }

    public static function log($data, $label = 'info', $channel = 'messages')
    {
        self::$debugbar[$channel]->addMessage($data, $label);
    }

    public static function startPage($name, $label, $channel = 'pages')
    {
        self::$debugbar[$channel]->startMeasure($name, $label);
    }

    public static function stopPage($name, $channel = 'pages')
    {
        if (self::$debugbar[$channel]->hasStartedMeasure($name)) self::$debugbar[$channel]->stopMeasure($name);
    }

    public static function logException($e)
    {
        self::$debugbar->getCollector('exceptions')->addException($e);
    }
}
