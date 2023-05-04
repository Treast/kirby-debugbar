<?php

use Treast\KirbyDebugbar\Debugbar;

if (option('debug')) {
  $renderer = Debugbar::getRenderer('/media/plugins/treast/debugbar');

  echo Debugbar::getRenderer()->renderHead();
  echo css('/media/plugins/treast/debugbar/index.css');
  echo Debugbar::getRenderer()->render();
}
