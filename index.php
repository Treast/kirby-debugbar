<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Cms\App as Kirby;

Kirby::plugin('treast/debugbar', [
    'hooks' => [
        'system.loadPlugins:after' => function () {
            \Treast\KirbyDebugbar\Debugbar::init(kirby());
        },
        'page.render:before' => function (string $contentType, array $data, \Kirby\Cms\Page $page) {
            \Treast\KirbyDebugbar\Debugbar::logFiles('Content', $page->contentFiles());
            \Treast\KirbyDebugbar\Debugbar::logFiles('Files', array_column($page->files()->toArray(), 'url'));
            \Treast\KirbyDebugbar\Debugbar::logFiles('Children', array_column(array_map(function ($child) {
                return $child['content'];
            }, $page->children()->toArray()), 'title'));
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
        'debugbar.footer' => __DIR__ . '/snippets/footer.php'
    ]
]);
