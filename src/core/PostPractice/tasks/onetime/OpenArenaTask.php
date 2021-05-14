<?php

declare(strict_types=1);

namespace core\PostPractice\tasks\onetime;

use pocketmine\level\Level;
use pocketmine\scheduler\Task;
use core\PostPractice\Core;
use core\PostPractice\Utils;

class OpenArenaTask extends Task{
	
	private $arena;
	
	public function __construct(Core $plugin, string $arena){
		$this->plugin=$plugin;
		$this->arena=$arena;
	}
	public function onRun(int $currentTick):void{
		$this->plugin->getArenaHandler()->setArenaOpen($this->arena);
	}
}
