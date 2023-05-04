<?php

if (option('debug')) {
  use Treast\KirbyDebugbar\Debugbar;

  $renderer = Debugbar::getRenderer('/media/plugins/treast/debugbar');

  echo Debugbar::getRenderer()->renderHead();
  echo css('/media/plugins/treast/debugbar/index.css');
  echo Debugbar::getRenderer()->render();
}
