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
            \Treast\KirbyDebugbar\Debugbar::init(kirby());
        },
        'page.render:before' => function (string $contentType, array $data, \Kirby\Cms\Page $page) {
            \Treast\KirbyDebugbar\Debugbar::logPage($page);
            return $data;
        },
        '*:after' => function (\Kirby\Cms\Event $event) {
            \Treast\KirbyDebugbar\Debugbar::logEvent($event);
        },
        'system.exception' => function (Throwable $exception) {
            if ($exception instanceof Exception) \Treast\KirbyDebugbar\Debugbar::logException($exception);
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
