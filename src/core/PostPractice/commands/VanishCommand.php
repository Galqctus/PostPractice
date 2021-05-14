<?php

namespace core\PostPractice\commands;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use core\PostPractice\Core;
use core\PostPractice\CPlayer;
use core\PostPractice\Utils;

class VanishCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct(Core $plugin){
		parent::__construct("vanish", $plugin);
		$this->plugin=$plugin;
		$this->setPermission("cp.command.vanish");
	}
	public function execute(CommandSender $player, string $commandLabel, array $args){
		if(!$player instanceof Player){
			return;
		}
		if(!$player->hasPermission("cp.command.vanish")){
			$player->sendMessage("§cYou can't execute this command.");
			return;
		}
		if(!$player->isOp()){
			if($player->isTagged()){
				$player->sendMessage("§cYou cannot use this command while in combat.");
				return;
			}
		}
		if(!$player->isVanished()){
			$this->plugin->getStaffUtils()->vanish($player, true);
		}else{
			$this->plugin->getStaffUtils()->vanish($player, false);
		}
	}
}
