<?php

use Treast\KirbyDebugbar\Debugbar;

$debugbarRenderer = Debugbar::getRenderer();

echo $debugbarRenderer->renderHead();
echo $debugbarRenderer->render();
