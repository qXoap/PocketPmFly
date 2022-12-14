<?php

namespace PocketPmFly\command;

use Forms\FormAPI\SimpleForm;
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
            if($player instanceof Player){
                if($player->hasPermission("pocketfly.cmd")){
                    if(Main::getInstance()->getConfig()->get("use-forms") === true){
                        $this->getForm($player);
                    }else if(Main::getInstance()->getConfig()->get("use-forms") === false){
                        $this->getNormalFly($player);
                    }
            }else{
                $prefix = Main::getInstance()->getConfig()->get("prefix");
                $noperms = Main::getInstance()->getConfig()->get("no-permission-message");
                $player->sendMessage(TextFormat::colorize($prefix.$noperms));
            }
        }else{

        }
    }

    public function getNormalFly(Player $player){
        if($player->getAllowFlight() === false){
            $prefix = Main::getInstance()->getConfig()->get("prefix");
            $active = Main::getInstance()->getConfig()->get("fly-active-message");
            $desactive = Main::getInstance()->getConfig()->get("fly-desactive-message");
            $player->setFlying(true);
            $player->setAllowFlight(true);
            $player->sendMessage(TextFormat::colorize($prefix.$active));
        }else{
            $prefix = Main::getInstance()->getConfig()->get("prefix");
            $active = Main::getInstance()->getConfig()->get("fly-active-message");
            $desactive = Main::getInstance()->getConfig()->get("fly-desactive-message");
            $player->setFlying(false);
            $player->setAllowFlight(false);
            $player->sendMessage(TextFormat::colorize($prefix.$desactive));
        }
    }

    public function getForm(Player $player){
        $menu = new SimpleForm(function (Player $player, int $data = null){
            if($data === null){
                return true;
            }
            $prefix = Main::getInstance()->getConfig()->get("prefix");
            $active = Main::getInstance()->getConfig()->get("fly-active-message");
            $desactive = Main::getInstance()->getConfig()->get("fly-desactive-message");
            switch($data){
                case 0:
                    $player->setFlying(true);
                    $player->setAllowFlight(true);
                    $player->sendMessage(TextFormat::colorize($prefix.$active));
                break;
                case 1:
                    $player->setFlying(false);
                    $player->setAllowFlight(false);
                    $player->sendMessage(TextFormat::colorize($prefix.$desactive));
                break;
                case 2:
                break;
            }
        });
        $menu->setTitle(TextFormat::colorize(Main::getInstance()->getConfig()->get("Form-Title")));
        $menu->addButton(TextFormat::colorize(Main::getInstance()->getConfig()->get("Button-Fly-On")));
        $menu->addButton(TextFormat::colorize(Main::getInstance()->getConfig()->get("Button-Fly-Off")));
        $menu->addButton(TextFormat::colorize(Main::getInstance()->getConfig()->get("Button-Close-Form")),0,"textures/ui/redX1");
        $player->sendForm($menu);
        return $menu;
    }
}