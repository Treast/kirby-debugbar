<?php

namespace Treast\KirbyDebugbar\DataCollector;

use DebugBar\DataCollector\Renderable;
use DebugBar\DataCollector\DataCollector;

class VariableCollector extends DataCollector implements Renderable
{
    protected string $name;
    protected array $content;

    public function __construct($name = 'variables')
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setContent(array $content)
    {
        $this->content = $content;
    }

    public function collect()
    {
        $data = [];

        foreach ($this->content as $key => $var) {
            $data[$key] = $this->getDataFormatter()->formatVar($var);
        }

        return $data;
    }

    public function getWidgets()
    {
        $name = $this->getName();

        return array(
            "$name" => array(
                "icon" => "tags",
                "widget" => "PhpDebugBar.Widgets.VariableListWidget",
                "map" => "$name",
                "default" => "{}"
            )
        );
    }
}
