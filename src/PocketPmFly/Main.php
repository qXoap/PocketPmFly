<?php

namespace PocketPmFly;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public static $instance;

    public function onEnable(): void{
        self::$instance = $this;
    }

    public static function getInstance(): Main{
        return self::$instance;
    }
}