<?php

namespace olympia\blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use pocketmine\block\Block;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static OrichalqueBlock ORICHALQUE_BLOCK()
 * @method static ChunkBuster CHUNK_BUSTER()
 * @method static NoPearlBlock NOPEARL_BLOCK()*
 * @method static OrichalqueOre ORICHALQUE_ORE()
 * @method static MythrilOre MYTHRIL_ORE()
 */

final class OlympiaBlocks {
    use CloningRegistryTrait;

    private const PREFIX = "olympia:";

    protected static function setup(): void {
        self::_registryRegister("orichalque_block", self::get("orichalque_block"));
        self::_registryRegister("chunk_buster", self::get("chunk_buster"));
        self::_registryRegister("nopearl_block", self::get("nopearl_block"));
        self::_registryRegister("orichalque_ore", self::get("orichalque_ore"));
        self::_registryRegister("mythril_ore", self::get("mythril_ore"));
    }

    private static function get($identifier): Block {
        return CustomiesBlockFactory::getInstance()->get(self::PREFIX . $identifier);
    }
}