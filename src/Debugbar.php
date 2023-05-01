<?php

namespace Treast\KirbyDebugbar;

use DebugBar\StandardDebugBar;

class Debugbar
{
    protected static $debugbar;

    public static function init()
    {
        self::$debugbar = new StandardDebugBar();
    }

    public static function getRenderer($baseUrl = null)
    {
        return self::$debugbar->getJavascriptRenderer($baseUrl);
    }

    public static function log($data, $channel = 'messages')
    {
        self::$debugbar[$channel]->addMessage($data);
    }
}
