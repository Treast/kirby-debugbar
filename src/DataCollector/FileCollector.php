<?php

namespace Treast\KirbyDebugbar\DataCollector;

use DebugBar\DataCollector\Renderable;
use DebugBar\DataCollector\DataCollector;

class FileCollector extends DataCollector implements Renderable
{
    protected string $name;
    protected array $files = [];

    public function __construct($name = "files")
    {
        $this->name = $name;
    }

    public function addFile(string $type, string $file)
    {
        if (!isset($this->files[$type])) $this->files[$type] = [];
        $this->files[$type][] = $file;
    }

    public function addFiles(string $type, array $files)
    {
        foreach ($files as $file) {
            if (is_string($file)) $this->addFile($type, $file);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function collect()
    {
        $data = [];

        foreach ($this->files as $type => $file) {
            $data[$type] = $this->getDataFormatter()->formatVar($file);
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
