<?php

declare(strict_types=1);

namespace core\PostPractice\tasks;

use pocketmine\Player;
use pocketmine\scheduler\Task;
use core\PostPractice\Core;
use core\PostPractice\CPlayer;
use core\PostPractice\Utils;

class CombatTask extends Task{
	
	public function __construct(Core $plugin){
		$this->plugin=$plugin;
	}
	public function onRun(int $currentTick):void{
		foreach($this->plugin->taggedPlayer as $name => $time) {
			$player=$this->plugin->getServer()->getPlayerExact($name);
			$time--;
			if($player->isTagged()){
				//$player->sendTip("In combat, please wait §b".$time."s");
				$this->plugin->getScoreboardHandler()->updateMainLineCombat($player, $time);
			}
			if($time<=0){
				$player->setTagged(false);
				//$this->plugin->getScoreboardHandler()->updateMainLineCombat($player, 0);
				return;
			}
			$this->plugin->taggedPlayer[$name]--;
		}
	}
}
