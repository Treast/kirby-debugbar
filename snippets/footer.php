<?php

use Treast\KirbyDebugbar\Debugbar;

$renderer = Debugbar::getRenderer('/media/plugins/treast/debugbar');

echo Debugbar::getRenderer()->renderHead();
echo Debugbar::getRenderer()->render();
