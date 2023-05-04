<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App as Kirby;

Kirby::plugin('treast/debugbar', [
    'options' => [
        'force' => false,
        'tabs' => [
            'logs' => true,
            'config' => true,
            'events' => true,
            'files' => true,
            'variables' => true,
            'request' => true,
            'exceptions' => true
        ]
    ],
    'hooks' => [
        'system.loadPlugins:after' => function () {
            if (option('debug')) {
                \Treast\KirbyDebugbar\Debugbar::init(kirby());
            }
        },
        'page.render:before' => function (string $contentType, array $data, \Kirby\Cms\Page $page) {
            if (option('debug')) {
                \Treast\KirbyDebugbar\Debugbar::logPage($page);
            }
            return $data;
        },
        '*:after' => function (\Kirby\Cms\Event $event) {
            if (option('debug')) {
                \Treast\KirbyDebugbar\Debugbar::logEvent($event);
            }
        },
        'system.exception' => function (Throwable $exception) {
            if (option('debug') && $exception instanceof Exception) \Treast\KirbyDebugbar\Debugbar::logException($exception);
        },
    ],
    'snippets' => [
        'debugbar' => __DIR__ . '/snippets/debugbar.php'
    ],
    'siteMethods' => [
        'logger' => function () {
            return \Treast\KirbyDebugbar\Debugbar::getLogger();
        },
        'log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)
    ],
    'pageMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
    'pagesMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
    'fieldMethods' => ['log' => fn ($field) => \Treast\KirbyDebugbar\Debugbar::logUtils($field)],
    'fileMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
    'filesMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
    'userMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
    'usersMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
    'collectionMethods' => ['log' => fn () => \Treast\KirbyDebugbar\Debugbar::logUtils($this)],
]);
