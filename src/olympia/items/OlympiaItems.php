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
        self::setupKey();
    }

    private static function setupTools(): void {
        /* MYTHRIL TOOLS */
        self::_registryRegister("mythril_sickle", CustomiesItemFactory::getInstance()->get(self::PREFIX . "mythril_sickle"));
    }

    private static function setupKey(): void {
        /* KEY */
        self::_registryRegister("cosmetique_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "cosmetique_key"));
        self::_registryRegister("epic_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "epic_key"));
        self::_registryRegister("event_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "event_key"));
        self::_registryRegister("item_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "item_key"));
        self::_registryRegister("mine_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "mine_key"));
        self::_registryRegister("store_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "store_key"));
        self::_registryRegister("vote_key", CustomiesItemFactory::getInstance()->get(self::PREFIX . "vote_key"));
    }

    private static function setupArmors(): void {}
}