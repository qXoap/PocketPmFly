<?php

namespace PocketPmFly;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityTeleportEvent;
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
}