<?php

namespace PocketPmFly;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\player\PlayerJoinEvent;
use PocketPmFly\Main;

class EventListener implements Listener {

    public function onChangeWorld(EntityTeleportEvent $ev){
        $entity = $ev->getEntity();
        if($entity instanceof Player){
            if(Main::getInstance()->getConfig()->get("remove-fly-when-changing-world") === true){
                $entity->setFlying(false);
                $entity->setAllowFlight(false);
            }
        }
    }

    public function onPlayerJoin(PlayerJoinEvent $ev){
        $player = $ev->getPlayer();
        if(Main::getInstance()->getConfig()->get("activate-fly-of-a-player-when-joining") === true){
            if($player->hasPermission("pocketfly.cmd")){
                $player->setFlying(true);
                $player->setAllowFlight(true);
            }
        }else if(Main::getInstance()->getConfig()->get("activate-fly-of-a-player-when-joining") === false){
            if($player->hasPermission("pocketfly.cmd")){
                $player->setFlying(false);
                $player->setAllowFlight(false);
            }
        }
    }
}