<?php

namespace olympia\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use olympia\items\armors\mythril\MythrilBoots;
use olympia\items\armors\mythril\MythrilChestplate;
use olympia\items\armors\mythril\MythrilHelmet;
use olympia\items\armors\mythril\MythrilLeggings;
use olympia\items\armors\orichalque\OrichalqueBoots;
use olympia\items\armors\orichalque\OrichalqueChestplate;
use olympia\items\armors\orichalque\OrichalqueHelmet;
use olympia\items\armors\orichalque\OrichalqueLeggings;
use olympia\items\key\CosmeticKey;
use olympia\items\key\EpicKey;
use olympia\items\key\EventKey;
use olympia\items\key\ItemKey;
use olympia\items\key\MineKey;
use olympia\items\key\StoreKey;
use olympia\items\key\VoteKey;
use olympia\items\tools\InfinitySword;
use olympia\items\tools\mythril\MythrilSickle;
use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;

/**
 * MYTHRIL TOOLS :
 * @method static MythrilSickle MYTHRIL_SICKLE()
 *
 * MYTHRIL ARMORS :
 * @method static OrichalqueBoots ORICHALQUE_BOOTS()
 * @method static OrichalqueLeggings ORICHALQUE_LEGGINGS()
 * @method static OrichalqueChestplate ORICHALQUE_CHESTPLATE()
 * @method static OrichalqueHelmet ORICHALQUE_HELMET()
 *
 * @method static MythrilBoots MYTHRIL_BOOTS()
 * @method static MythrilLeggings MYTHRIL_LEGGINGS()
 * @method static MythrilChestplate MYTHRIL_CHESTPLATE()
 * @method static MythrilHelmet MYTHRIL_HELMET()
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
        self::setupArmors();
    }

    private static function setupTools(): void {
        /* MYTHRIL TOOLS */
        self::_registryRegister("mythril_sickle", self::get("mythril_sickle"));

        /* SPECIAL */
        self::_registryRegister("infinite_sword", self::get("infinite_sword"));
    }

    private static function setupArmors(): void {
        /* MYTHRIL */
        self::_registryRegister("mythril_boots", self::get("mythril_boots"));
        self::_registryRegister("mythril_leggings", self::get("mythril_leggings"));
        self::_registryRegister("mythril_chestplate", self::get("mythril_chestplate"));
        self::_registryRegister("mythril_helmet", self::get("mythril_helmet"));

        /* ORICHALQUE */
        self::_registryRegister("orichalque_boots", self::get("orichalque_boots"));
        self::_registryRegister("orichalque_leggings", self::get("orichalque_leggings"));
        self::_registryRegister("orichalque_chestplate", self::get("orichalque_chestplate"));
        self::_registryRegister("orichalque_helmet", self::get("orichalque_helmet"));

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

    private static function get($identifier): Item {
        return CustomiesItemFactory::getInstance()->get(self::PREFIX . $identifier);
    }
}