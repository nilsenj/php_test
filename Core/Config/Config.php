<?php

namespace Core\Config;

use Noodlehaus\Config as Configurator;

class Config
{
    protected $path;
    protected $conf;

    public function __construct($path = '')
    {
        $this->path = $path;
        $this->conf = new Configurator($path);
    }

    public function getConfig($configPath) {

        return $this->conf->get($configPath);
    }
}