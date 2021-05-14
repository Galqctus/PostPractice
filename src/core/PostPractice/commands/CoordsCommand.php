<?php

namespace core\PostPractice\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use core\PostPractice\Core;
use core\PostPractice\CPlayer;
use core\PostPractice\Utils;

class CoordsCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct(Core $plugin){
		parent::__construct("coords", $plugin);
		$this->plugin=$plugin;
		$this->setPermission("cp.command.coords");
	}
	public function execute(CommandSender $player, string $commandLabel, array $args){
		if(!$player instanceof Player){
			return;
		}
		if(!$player->hasPermission("cp.command.coords")){
			$player->sendMessage("§cYou can't execute this command.");
			return;
		}
		if(!$player->isOp()){
			if($player->isTagged()){
				$player->sendMessage("§cYou cannot use this command while in combat.");
				return;
			}
		}
		if(!$player->isCoordins()){
			$this->plugin->getStaffUtils()->coords($player, true);
		}else{
			$this->plugin->getStaffUtils()->coords($player, false);
		}
	}
}
