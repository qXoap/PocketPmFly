<?php

namespace PocketPmFly;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use PocketPmFly\command\FlyCommand;

class Main extends PluginBase {

    public static $instance;

    public function onEnable(): void{
        self::$instance = $this;
        Server::getInstance()->getCommandMap()->register("fly", new FlyCommand());
    }

    public static function getInstance(): Main{
        return self::$instance;
    }
}