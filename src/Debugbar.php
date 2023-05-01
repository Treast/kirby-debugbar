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

    public static function getRenderer()
    {
        return self::$debugbar->getJavascriptRenderer();
    }
}
