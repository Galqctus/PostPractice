<?php

declare(strict_types=1);

namespace core\PostPractice\tasks;

use pocketmine\scheduler\Task;
use core\PostPractice\Core;
use core\PostPractice\CPlayer;

class PlayerTask extends Task{
	
	public function __construct(Core $plugin){
		$this->plugin=$plugin;
	}
	public function onRun(int $tick):void{
		$players=$this->plugin->getServer()->getLoggedInPlayers();
		foreach($players as $player){
			if($player instanceof CPlayer){
				$player->update();
			}
		}
	}
}
