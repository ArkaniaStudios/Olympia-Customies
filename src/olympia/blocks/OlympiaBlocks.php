<?php

namespace olympia\blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use pocketmine\block\Block;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static OrichalqueBlock ORICHALQUE_BLOCK()
 */

final class OlympiaBlocks {
    use CloningRegistryTrait;

    private const PREFIX = "olympia:";

    protected static function setup(): void {
        self::_registryRegister("orichalque_block", self::get("orichalque_block"));
    }

    private static function get($identifier): Block {
        return CustomiesBlockFactory::getInstance()->get(self::PREFIX . $identifier);
    }
}