<?php

namespace Treast\KirbyDebugbar\DataCollector;

use DebugBar\DataCollector\Renderable;
use DebugBar\DataCollector\TimeDataCollector;

class PageCollector extends TimeDataCollector implements Renderable
{
    protected $name;

    public function __construct($name = 'pages')
    {
        parent::__construct();
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getWidgets()
    {
        $name = $this->getName();

        return array(
            "time" => array(
                "icon" => "clock-o",
                "tooltip" => "Request Duration",
                "map" => "time.duration_str",
                "default" => "'0ms'"
            ),
            "$name" => array(
                "icon" => "tasks",
                "widget" => "PhpDebugBar.Widgets.TimelineWidget",
                "map" => "time",
                "default" => "{}"
            )
        );
    }
}
