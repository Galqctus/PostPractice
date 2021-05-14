<?php

declare(strict_types=1);

namespace core\PostPractice\tasks\onetime;

use pocketmine\entity\Entity;
use pocketmine\scheduler\Task;
use core\PostPractice\Core;
use core\PostPractice\Utils;

class CloseEntityTask extends Task{
	
	private $entity;
	
	public function __construct(Core $plugin, Entity $entity){
		$this->plugin=$plugin;
		$this->entity=$entity;
	}
	public function onRun(int $currentTick):void{
		if(!$this->entity->isClosed()){
			$this->entity->close();
		}
	}
}
