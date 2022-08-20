<?php

namespace PocketPmFly\command;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use PocketPmFly\Main;

class FlyCommand extends Command {

    public function __construct()
    {
        parent::__construct("fly", "Active/Desactive Fly In Survival", null, []);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        $prefix = Main::getInstance()->getConfig()->get("prefix");
        $noperms = Main::getInstance()->getConfig()->get("no-permission-message");
            if($player instanceof Player){
                if($player->hasPermission("pocketfly.cmd")){
                    $player->sendMessage(TextFormat::colorize($prefix.$noperms));
                    return false;
                if(Main::getInstance()->getConfig()->get("use-forms") === true){
                    $this->getForm($player);
                }else if(Main::getInstance()->getConfig()->get("use-forms") === false){
                    $this->getNormalFly($player);
                }
            }else{

            }
        }
    }

    public function getNormalFly(Player $player){
        $prefix = Main::getInstance()->getConfig()->get("prefix");
        $active = Main::getInstance()->getConfig()->get("fly-active-message");
        $desactive = Main::getInstance()->getConfig()->get("fly-desactive-message");
        $noperms = Main::getInstance()->getConfig()->get("no-permission-message");
        if($player->getAllowFlight() === false){
            $player->setFlying(true);
            $player->setAllowFlight(true);
            $player->sendMessage(TextFormat::colorize($prefix.$active));
        }else{
            $player->setFlying(false);
            $player->setAllowFlight(false);
            $player->sendMessage(TextFormat::colorize($prefix.$desactive));
        }
    }
}