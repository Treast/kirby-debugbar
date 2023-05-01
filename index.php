<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App as Kirby;

Kirby::plugin('treast/debugbar', [
    'hooks' => [
        'system.loadPlugins:after' => function () {
            \Treast\KirbyDebugbar\Debugbar::init(kirby());
        },
        '*:after' => function (\Kirby\Cms\Event $event) {
            \Treast\KirbyDebugbar\Debugbar::logEvent($event);
        },
        'system.exception' => function (Throwable $exception) {
            if ($exception instanceof Exception) \Treast\KirbyDebugbar\Debugbar::logException($exception);
        },
    ],
    'snippets' => [
        'debugbar.footer' => __DIR__ . '/snippets/footer.php'
    ]
]);
