<?php

namespace olympia\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use olympia\items\mythril\MythrilSickle;
use pocketmine\utils\CloningRegistryTrait;

/**
 * MYTHRIL TOOLS :
 * @method static MythrilSickle MYTHRIL_SICKLE()
 */

final class OlympiaItems {
    use CloningRegistryTrait;

    private const PREFIX = "olympia:";

    public static function setup(): void {
        self::setupTools();
        self::setupArmors();
    }

    private static function setupTools(): void {
        /* MYTHRIL TOOLS */
        self::_registryRegister("mythril_sickle", CustomiesItemFactory::getInstance()->get(self::PREFIX . "mythril_sickle"));
    }

    private static function setupArmors(): void {}
}