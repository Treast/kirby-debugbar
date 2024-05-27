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
        if (option('treast.debugbar.tabs.logs')) self::$debugbar->addCollector(new MessagesCollector('logs'));
        if (option('treast.debugbar.tabs.config')) self::$debugbar->addCollector(new ConfigCollector($config));
        if (option('treast.debugbar.tabs.events')) self::$debugbar->addCollector(new EventCollector());
        if (option('treast.debugbar.tabs.files')) self::$debugbar->addCollector(new FileCollector());
        if (option('treast.debugbar.tabs.variables')) self::$debugbar->addCollector(new VariableCollector());
        if (option('treast.debugbar.tabs.exceptions')) self::$debugbar->addCollector(new ExceptionsCollector());
        if (option('treast.debugbar.tabs.request')) self::$debugbar->addCollector(new RequestDataCollector());
        self::$debugbar->addCollector(new PhpInfoCollector());
        self::$debugbar->addCollector(new MemoryCollector());
    }

    public static function getLogger()
    {
        return self::$logger;
    }

    public static function getRenderer($baseUrl = null)
    {
        return self::$debugbar->getJavascriptRenderer($baseUrl);
    }

    public static function logUtils(mixed $data)
    {
        self::log($data, 'debug');
        return $data;
    }

    public static function log($data, $label = 'info', $channel = 'logs')
    {
        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.logs')) self::$debugbar->getCollector($channel)->addMessage($data, $label);
    }

    public static function logEvent(Event $event)
    {
        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.events')) self::log($event, 'info', 'events');
    }

    public static function logException(\Exception $e)
    {
        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.exceptions')) self::$debugbar->getCollector('exceptions')->addException($e);
    }

    private static function logFiles(string $type, array $files)
    {
        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.files')) self::$debugbar->getCollector('files')->addFiles($type, $files);
    }

    private static function logVariables($content)
    {
        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.variables')) self::$debugbar->getCollector('variables')->setContent($content);
    }

    public static function logPage(Page $page)
    {
        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.files')) {
            self::logFiles('Content', $page->content()->toArray());
            self::logFiles('Files', array_column($page->files()->toArray(), 'url'));
            self::logFiles('Children', array_column(array_map(function ($child) {
                return $child['content'];
            }, $page->children()->toArray()), 'title'));
        }

        if ((option('debug') || option('treast.debugbar.force')) && option('treast.debugbar.tabs.variables')) self::logVariables($page->content()->data());
    }
}
