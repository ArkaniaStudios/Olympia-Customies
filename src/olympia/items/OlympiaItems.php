<?php

namespace olympia\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use olympia\items\key\CosmeticKey;
use olympia\items\key\EpicKey;
use olympia\items\key\EventKey;
use olympia\items\key\ItemKey;
use olympia\items\key\MineKey;
use olympia\items\key\StoreKey;
use olympia\items\key\VoteKey;
use olympia\items\mythril\MythrilSickle;
use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;

/**
 * MYTHRIL TOOLS :
 * @method static MythrilSickle MYTHRIL_SICKLE()
 *
 * SPECIAL :
 * @method static InfinitySword INFINITY_SWORD()
 *
 * KEY :
 * @method static CosmeticKey COSMETIC_KEY()
 * @method static EpicKey EPIC_KEY()
 * @method static EventKey EVENT_KEY()
 * @method static ItemKey ITEM_KEY()
 * @method static MineKey MINE_KEY()
 * @method static StoreKey STORE_KEY()
 * @method static VoteKey VOTE_KEY()
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
        self::_registryRegister("mythril_sickle", self::get("mythril_sickle"));

        /* SPECIAL */
        self::_registryRegister("infinite_sword", self::get("infinite_sword"));
    }

    private static function setupKey(): void {
        self::_registryRegister("cosmetic_key", self::get("cosmetic_key"));
        self::_registryRegister("epic_key", self::get("epic_key"));
        self::_registryRegister("event_key", self::get("event_key"));
        self::_registryRegister("item_key", self::get("item_key"));
        self::_registryRegister("mine_key", self::get("mine_key"));
        self::_registryRegister("store_key", self::get("store_key"));
        self::_registryRegister("vote_key", self::get("vote_key"));
    }

    private static function setupArmors(): void {}

    private static function get($identifier): Item {
        return CustomiesItemFactory::getInstance()->get(self::PREFIX . $identifier);
    }
}