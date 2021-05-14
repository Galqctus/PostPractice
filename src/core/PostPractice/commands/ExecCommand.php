<?php

declare(strict_types=1);

namespace core\PostPractice\Commands;

use pocketmine\Player;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use core\PostPractice\Core;
use core\PostPractice\Utils;

class ExecCommand extends PluginCommand{
	
	private $plugin;
	
	public function __construct(Core $plugin){
		parent::__construct("exec", $plugin);
		$this->plugin=$plugin;
		$this->setPermission("cp.command.exec");
	}
	public function execute(CommandSender $player, string $commandLabel, array $args){
		if($player instanceof Player){
			return;
		}
		if(!$player->hasPermission("cp.command.exec")){
			return;
		}
		Utils::offerVoteRewards(implode(" ", $args));
	}
}
