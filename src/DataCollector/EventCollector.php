<?php

namespace Treast\KirbyDebugbar\DataCollector;

use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DataCollector\Renderable;

class EventCollector extends MessagesCollector implements Renderable
{
    protected $name;

    public function __construct($name = 'events')
    {
        $this->name = $name;
    }
}
