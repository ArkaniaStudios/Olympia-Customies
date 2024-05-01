<?php

namespace olympia\items;

use customiesdevs\customies\item\CustomiesItemFactory;
use olympia\items\armors\cronos\CronosBoots;
use olympia\items\armors\cronos\CronosChestplate;
use olympia\items\armors\cronos\CronosHelmet;
use olympia\items\armors\cronos\CronosLeggings;
use olympia\items\armors\farm\FarmBoots;
use olympia\items\armors\farm\FarmChestplate;
use olympia\items\armors\farm\FarmHelmet;
use olympia\items\armors\farm\FarmLeggings;
use olympia\items\armors\mythril\MythrilBoots;
use olympia\items\armors\mythril\MythrilChestplate;
use olympia\items\armors\mythril\MythrilHelmet;
use olympia\items\armors\mythril\MythrilLeggings;
use olympia\items\armors\orichalque\OrichalqueBoots;
use olympia\items\armors\orichalque\OrichalqueChestplate;
use olympia\items\armors\orichalque\OrichalqueHelmet;
use olympia\items\armors\orichalque\OrichalqueLeggings;
use olympia\items\armors\theia\TheiaBoots;
use olympia\items\armors\theia\TheiaChestplate;
use olympia\items\armors\theia\TheiaHelmet;
use olympia\items\armors\theia\TheiaLeggings;
use olympia\items\ingots\MythrilIngot;
use olympia\items\ingots\OrichalqueIngot;
use olympia\items\key\CosmeticKey;
use olympia\items\key\EpicKey;
use olympia\items\key\EventKey;
use olympia\items\key\ItemKey;
use olympia\items\key\MineKey;
use olympia\items\key\StoreKey;
use olympia\items\key\VoteKey;
use olympia\items\others\SoupItem;
use olympia\items\partners\FishKnockback;
use olympia\items\tools\InfinitySword;
use olympia\items\tools\mythril\MythrilSickle;
use olympia\items\tools\mythril\MythrilSword;
use olympia\items\tools\mythril\OrichalqueSword;
use pocketmine\item\Item;
use pocketmine\utils\CloningRegistryTrait;

/**
 * MYTHRIL TOOLS :
 * @method static MythrilSickle MYTHRIL_SICKLE()
 *
 * ORICHALQUE ARMORS :
 * @method static OrichalqueBoots ORICHALQUE_BOOTS()
 * @method static OrichalqueLeggings ORICHALQUE_LEGGINGS()
 * @method static OrichalqueChestplate ORICHALQUE_CHESTPLATE()
 * @method static OrichalqueHelmet ORICHALQUE_HELMET()
 *
 * MYTHRIL ARMORS :
 * @method static MythrilBoots MYTHRIL_BOOTS()
 * @method static MythrilLeggings MYTHRIL_LEGGINGS()
 * @method static MythrilChestplate MYTHRIL_CHESTPLATE()
 * @method static MythrilHelmet MYTHRIL_HELMET()
 *
 * CRONOS ARMORS :
 * @method static CronosBoots CRONOS_BOOTS()
 * @method static CronosLeggings CRONOS_LEGGINGS()
 * @method static CronosChestplate CRONOS_CHESTPLATE()
 * @method static CronosHelmet CRONOS_HELMET()
 *
 * THEIA ARMORS :
 * @method static TheiaBoots THEIA_BOOTS()
 * @method static TheiaLeggings THEIA_LEGGINGS()
 * @method static TheiaChestplate THEIA_CHESTPLATE()
 * @method static TheiaHelmet THEIA_HELMET()
 *
 * FARM ARMORS :
 * @method static FarmBoots FARM_BOOTS()
 * @method static FarmLeggings FARM_LEGGINGS()
 * @method static FarmChestplate FARM_CHESTPLATE()
 * @method static FarmHelmet FARM_HELMET()
 *
 * SPECIAL :
 * @method static InfinitySword INFINITY_SWORD()
 *
 * ITEMS :
 * @method static MythrilIngot MYTHRIL_INGOT()
 * @method static OrichalqueIngot ORICHALQUE_INGOT()
 * @method static SoupItem SOUP_ITEM()
 * @method static OrichalqueSword ORICHALQUE_SWORD()
 * @method static MythrilSword MYTHRIL_SWORD()
 *
 * KEY :
 * @method static CosmeticKey COSMETIC_KEY()
 * @method static EpicKey EPIC_KEY()
 * @method static EventKey EVENT_KEY()
 * @method static ItemKey ITEM_KEY()
 * @method static MineKey MINE_KEY()
 * @method static StoreKey STORE_KEY()
 * @method static VoteKey VOTE_KEY()
 *
 * PARTNERS :
 * @method static FishKnockback FISH_KNOCKBACK()
 */

final class OlympiaItems {
    use CloningRegistryTrait;

    private const PREFIX = "olympia:";

    public static function setup(): void {
        self::setupTools();
        self::setupArmors();
        self::setupKey();
        self::setupPartners();

        self::_registryRegister("mythril_ingot", self::get("mythril_ingot"));
        self::_registryRegister("orichalque_ingot", self::get("orichalque_ingot"));
        self::_registryRegister("soup_item", self::get("soup_item"));
        self::_registryRegister("orichalque_sword", self::get("orichalque_sword"));
        self::_registryRegister("mythril_sword", self::get("mythril_sword"));
    }

    private static function setupTools(): void {
        /* MYTHRIL TOOLS */
        self::_registryRegister("mythril_sickle", self::get("mythril_sickle"));

        /* SPECIAL */
        self::_registryRegister("infinity_sword", self::get("infinity_sword"));
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

        /* THEIA */
        self::_registryRegister("theia_boots", self::get("theia_boots"));
        self::_registryRegister("theia_leggings", self::get("theia_leggings"));
        self::_registryRegister("theia_chestplate", self::get("theia_chestplate"));
        self::_registryRegister("theia_helmet", self::get("theia_helmet"));

        /* CRONOS */
        self::_registryRegister("cronos_boots", self::get("cronos_boots"));
        self::_registryRegister("cronos_leggings", self::get("cronos_leggings"));
        self::_registryRegister("cronos_chestplate", self::get("cronos_chestplate"));
        self::_registryRegister("cronos_helmet", self::get("cronos_helmet"));

        /* FARM */
        self::_registryRegister("farm_boots", self::get("farm_boots"));
        self::_registryRegister("farm_leggings", self::get("farm_leggings"));
        self::_registryRegister("farm_chestplate", self::get("farm_chestplate"));
        self::_registryRegister("farm_helmet", self::get("farm_helmet"));

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

    private static function setupPartners(): void {
        self::_registryRegister("fish_knockback", self::get("fish_knockback"));
    }

    private static function get($identifier): Item {
        return CustomiesItemFactory::getInstance()->get(self::PREFIX . $identifier);
    }
}