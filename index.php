<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('treast/debugbar', [
    'hooks' => [
        'system.loadPlugins:after' => function () {
            \Treast\KirbyDebugbar\Debugbar::init();
        },
        '*:after' => function (\Kirby\Cms\Event $event) {
            \Treast\KirbyDebugbar\Debugbar::log($event);
        },
    ],
    'snippets' => [
        'debugbar.footer' => __DIR__ . '/snippets/footer.php'
    ]
]);
