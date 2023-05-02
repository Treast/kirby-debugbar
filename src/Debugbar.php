<?php

namespace Treast\KirbyDebugbar;

use Kirby\Cms\App;
use Kirby\Cms\Page;
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
use Treast\KirbyDebugbar\DataCollector\VariableCollector;

class Debugbar
{
    protected static App $kirby;
    protected static Logger $logger;
    protected static DebugBarDebugBar $debugbar;

    public static function init(App $kirby)
    {
        $config = F::load($kirby->root('config') . '/config.php');

        self::$logger = new Logger();

        self::$debugbar = new DebugBarDebugBar();
        self::$debugbar->addCollector(new MessagesCollector('logs'));
        self::$debugbar->addCollector(new ConfigCollector($config));
        self::$debugbar->addCollector(new EventCollector());
        self::$debugbar->addCollector(new FileCollector());
        self::$debugbar->addCollector(new VariableCollector());
        self::$debugbar->addCollector(new PhpInfoCollector());
        self::$debugbar->addCollector(new RequestDataCollector());
        self::$debugbar->addCollector(new MemoryCollector());
        self::$debugbar->addCollector(new ExceptionsCollector());
    }

    public static function getLogger()
    {
        return self::$logger;
    }

    public static function getRenderer($baseUrl = null)
    {
        return self::$debugbar->getJavascriptRenderer($baseUrl);
    }

    public static function log($data, $label = 'info', $channel = 'logs')
    {
        self::$debugbar->getCollector($channel)->addMessage($data, $label);
    }

    public static function logEvent(Event $event)
    {
        self::log($event, 'info', 'events');
    }

    public static function logException(\Exception $e)
    {
        self::$debugbar->getCollector('exceptions')->addException($e);
    }

    private static function logFiles(string $type, array $files)
    {
        self::$debugbar->getCollector('files')->addFiles($type, $files);
    }

    private static function logVariables($content)
    {
        self::$debugbar->getCollector('variables')->setContent($content);
    }

    public static function logPage(Page $page)
    {
        self::logFiles('Content', $page->contentFiles());
        self::logFiles('Files', array_column($page->files()->toArray(), 'url'));
        self::logFiles('Children', array_column(array_map(function ($child) {
            return $child['content'];
        }, $page->children()->toArray()), 'title'));
        self::logVariables($page->content()->data());
    }
}
