<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App as Kirby;

Kirby::plugin('treast/debugbar', [
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
        }
    ]
]);
