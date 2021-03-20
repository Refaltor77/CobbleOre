<?php

namespace CobbleOre\refaltor;

use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Register extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->saveDefaultConfig();
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
    }

    public function onBreak(BlockBreakEvent $event){
        $block = $event->getBlock();
        if ($block->getId() === Block::STONE){
            if (mt_rand(1, $this->getConfig()->get("chance")) === 1){
                $drops = explode(":", $this->getConfig()->get("drops")[array_rand($this->getConfig()->get("drops"))]);
                $event->setDrops([Item::get($drops[0], $drops[1], $drops[2])->setCustomName($drops[3])]);
            }
        }
    }
}