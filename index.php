<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('treast/debugbar', [
    'hooks' => [
        'system.loadPlugins:after' => function () {
            \Treast\KirbyDebugbar\Debugbar::init();
        },
    ],
    'snippets' => [
        'debugbar' => __DIR__ . '/snippets/debugbar.php'
    ]
]);
