<?php

namespace olympia;

use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use olympia\blocks\BlockUtils;
use olympia\blocks\ChunkBuster;
use olympia\blocks\NoPearlBlock;
use olympia\blocks\OrichalqueBlock;
use olympia\items\armors\cronos\CronosBoots;
use olympia\items\armors\cronos\CronosChestplate;
use olympia\items\armors\cronos\CronosHelmet;
use olympia\items\armors\cronos\CronosLeggings;
use olympia\items\armors\farm\FarmBoots;
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
use olympia\items\ItemUtils;
use olympia\items\key\CosmeticKey;
use olympia\items\key\EpicKey;
use olympia\items\key\EventKey;
use olympia\items\key\ItemKey;
use olympia\items\key\MineKey;
use olympia\items\key\StoreKey;
use olympia\items\key\VoteKey;
use olympia\items\others\FlySoup;
use olympia\items\others\SoupItem;
use olympia\items\partners\EggTrap;
use olympia\items\partners\FishKnockback;
use olympia\items\partners\InfernalStick;
use olympia\items\partners\LevitationItem;
use olympia\items\partners\NobuildStick;
use olympia\items\partners\NoPearlStick;
use olympia\items\partners\PortalTPItem;
use olympia\items\partners\ResistanceItem;
use olympia\items\partners\RocketItem;
use olympia\items\partners\StrengthItem;
use olympia\items\partners\SwitchBall;
use olympia\items\tools\EvolvingPickaxe;
use olympia\items\tools\InfinitySword;
use olympia\items\tools\mythril\MythrilSickle;
use olympia\items\tools\mythril\MythrilSword;
use olympia\items\tools\orichalque\OrichalqueSickle;
use olympia\items\tools\orichalque\OrichalqueSword;

class Register {

    public static function registerAll(): void {
        self::item();
        self::block();
    }

    private static function item(): void {
        $i = ItemUtils::getInstance();

        /* MYTHRIL */
        $i->register(MythrilSickle::class, "mythril_sickle", "Faucille en mythril");

        /* ORICHALQUE */
        $i->register(OrichalqueSickle::class, "orichalque_sickle", "Faucille en orichalque");

        /* ARMOR */

        $i->register(MythrilBoots::class, "mythril_boots", "Bottes en mythril");
        $i->register(MythrilLeggings::class, "mythril_leggings", "Jambières en mythril");
        $i->register(MythrilChestplate::class, "mythril_chestplate", "Plastron en mythril");
        $i->register(MythrilHelmet::class, "mythril_helmet", "Casque en mythril");

        $i->register(OrichalqueBoots::class, "orichalque_boots", "Bottes en orichalque");
        $i->register(OrichalqueLeggings::class, "orichalque_leggings", "Jambières en orichalque");
        $i->register(OrichalqueChestplate::class, "orichalque_chestplate", "Plastron en orichalque");
        $i->register(OrichalqueHelmet::class, "orichalque_helmet", "Casque en orichalque");

        $i->register(TheiaBoots::class, "theia_boots", "Bottes en theia");
        $i->register(TheiaLeggings::class, "theia_leggings", "Jambières en theia");
        $i->register(TheiaChestplate::class, "theia_chestplate", "Plastron en theia");
        $i->register(TheiaHelmet::class, "theia_helmet", "Casque en theia");

        $i->register(CronosBoots::class, "cronos_boots", "Bottes en cronos");
        $i->register(CronosLeggings::class, "cronos_leggings", "Jambières en cronos");
        $i->register(CronosChestplate::class, "cronos_chestplate", "Plastron en cronos");
        $i->register(CronosHelmet::class, "cronos_helmet", "Casque en cronos");

        $i->register(FarmBoots::class, "farm_boots", "Bottes en farm");
        $i->register(FarmLeggings::class, "farm_leggings", "Jambières en farm");

        /* KEY */
        $i->register(VoteKey::class, "vote_key", "Clé Vote");
        $i->register(EpicKey::class, "epic_key", "Clé Epic");
        $i->register(MineKey::class, "mine_key", "Clé Mine");
        $i->register(ItemKey::class, "item_key", "Clé Item");
        $i->register(StoreKey::class, "store_key", "Clé Boutique");
        $i->register(CosmeticKey::class, "cosmetic_key", "Clé Cosmétique");
        $i->register(EventKey::class, "event_key", "Clé Evenement");

        /* ITEMS */
        $i->register(MythrilIngot::class, "mythril_ingot", "L'ingot de Mythril");
        $i->register(OrichalqueIngot::class, "orichalque_ingot", "L'ingot d'Orichalque");
        $i->register(SoupItem::class, "soup_item", "Soupe");
        $i->register(MythrilSword::class, "mythril_sword", "Epée en mythril");
        $i->register(OrichalqueSword::class, "orichalque_sword", "Epée en orichalque");
        $i->register(FlySoup::class, "fly_soup", "Soupe de Fly");

        /* SPECIAL */
        $i->register(InfinitySword::class, "infinity_sword", "Epée de l'infinie");
        $i->register(EvolvingPickaxe::class, "evolving_pickaxe", "Pioche évolutive");

        /* PARTNERS */
        $i->register(FishKnockback::class, "fish_knockback", "Poisson knockback");
        $i->register(RocketItem::class, "rocket_item", "Rocket");
        $i->register(ResistanceItem::class, "resistance_item", "Resistance");
        $i->register(LevitationItem::class, "levitation_item", "Levitation");
        $i->register(StrengthItem::class, "strength_item", "Strength");
        $i->register(PortalTPItem::class, "portal_item", "PortalTP");
        $i->register(SwitchBall::class, "switch_ball", "SwitchBall");
        $i->register(NoPearlStick::class, "nopearl_stick", "Bâton AntiPearl");
        $i->register(NobuildStick::class, "nobuild_stick", "Bâton AntiBuild");
        $i->register(InfernalStick::class, "infernal_stick", "Bâton Infernal");
        $i->register(EggTrap::class, "eggtrap_item", "Piège à toile");
    }

    private static function block(): void {
        $b = BlockUtils::getInstance();
        $b->register(ChunkBuster::class, "chunk_buster", "chunk_buster", Model::SOLID, "geometry.block", CreativeInventoryInfo::CATEGORY_CONSTRUCTION);
        $b->register(OrichalqueBlock::class, "orichalque_block", "orichalque_block");
        $b->register(NoPearlBlock::class, "nopearl_block", "nopearl_block");
    }
}