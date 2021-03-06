<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\level\Level;
use pocketmine\Player;

class Ice extends Transparent{

	protected $id = self::ICE;

	public function __construct(int $meta = 0){
		$this->meta = $meta;
	}

	public function getName() : string{
		return "Ice";
	}

	public function getHardness() : float{
		return 0.5;
	}

	public function getLightFilter() : int{
		return 2;
	}

	public function getToolType() : int{
		return Tool::TYPE_PICKAXE;
	}

	public function onBreak(Item $item, Player $player = null) : bool{
		$this->getLevel()->setBlock($this, BlockFactory::get(Block::WATER), true);

		return true;
	}

	public function onUpdate(int $type){
		if($type === Level::BLOCK_UPDATE_RANDOM){
			if($this->level->getHighestAdjacentBlockLight($this->x, $this->y, $this->z) >= 12){
				$this->level->useBreakOn($this);

				return $type;
			}
		}
		return false;
	}

	public function getDrops(Item $item) : array{
		return [];
	}
}