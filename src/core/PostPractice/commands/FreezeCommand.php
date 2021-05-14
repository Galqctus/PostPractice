<?php

declare(strict_types=1);

namespace core\PostPractice\commands;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use core\PostPractice\Core;
use core\PostPractice\StaffUtils;

class FreezeCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct(Core $plugin){
		parent::__construct("freeze", $plugin);
		$this->plugin=$plugin;
		$this->setPermission("cp.command.freeze");
		$this->setAliases(["ss"]);
	}
	public function execute(CommandSender $player, string $commandLabel, array $args){
		if(!$player->hasPermission("cp.command.freeze")){
			$player->sendMessage("§cYou cannot execute this command.");
			return;
		}
		if(!isset($args[0])){
			$player->sendMessage("§cYou must provide a player.");
			return;
		}
		if($this->plugin->getServer()->getPlayer($args[0])===null){
			$player->sendMessage("§cPlayer not found.");
			return;
		}
		$target=$this->plugin->getServer()->getPlayer($args[0]);
		if($target->getName()==$player->getName()){
			$player->sendMessage("§cYou cannot freeze yourself.");
			return;
		}
		$target=$this->plugin->getServer()->getPlayer($args[0]);
		if($target->isOp() or $target->hasPermission("cp.command.freeze")){
			$player->sendMessage("§cThis player cannot cannot be frozen.");
			return;
		}
		$target=$this->plugin->getServer()->getPlayer($args[0]);
		if($target->isFrozen()){
			$target->setFrozen(false);
			$target->setImmobile(false);
			$target->sendMessage("§cYou have been unfrozen.");
			$player->sendMessage("§aYou unfroze ".$target->getName().".");
			//$this->plugin->getServer()->broadcastMessage("§c".$target->getName()." was unfrozen by ".$player->getName().".");
			$message=$this->plugin->getStaffUtils()->sendStaffNoti("unfreeze");
			$message=str_replace("{name}", $player->getName(), $message);
			$message=str_replace("{target}", $target->getName(), $message);
			foreach($this->plugin->getServer()->getOnlinePlayers() as $online){
				if($online->hasPermission("cp.staff.notifications")){
					$online->sendMessage($message);
				}
			}
			return;
		}else{
			$target->setFrozen(true);
			$target->setImmobile(true);
			$target->sendMessage("§cYou have been frozen.");
			$player->sendMessage("§aYou froze ".$target->getName().".");
			//$this->plugin->getServer()->broadcastMessage("§c".$target->getName()." was frozen by ".$player->getName().".");
			$message=$this->plugin->getStaffUtils()->sendStaffNoti("freeze");
			$message=str_replace("{name}", $player->getName(), $message);
			$message=str_replace("{target}", $target->getName(), $message);
			foreach($this->plugin->getServer()->getOnlinePlayers() as $online){
				if($online->hasPermission("cp.staff.notifications")){
					$online->sendMessage($message);
				}
			}
			return;
		}
	}
}
