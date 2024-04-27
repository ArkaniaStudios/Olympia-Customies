<?php

namespace olympia;

use olympia\blocks\BlockUtils;
use olympia\blocks\ChunkBuster;
use olympia\items\armors\mythril\MythrilBoots;
use olympia\items\armors\mythril\MythrilChestplate;
use olympia\items\armors\mythril\MythrilHelmet;
use olympia\items\armors\mythril\MythrilLeggings;
use olympia\items\armors\orichalque\OrichalqueBoots;
use olympia\items\armors\orichalque\OrichalqueChestplate;
use olympia\items\armors\orichalque\OrichalqueHelmet;
use olympia\items\armors\orichalque\OrichalqueLeggings;
use olympia\items\InfinitySword;
use olympia\items\ItemUtils;

// Key
use olympia\items\key\CosmeticKey;
use olympia\items\key\EpicKey;
use olympia\items\key\EventKey;
use olympia\items\key\ItemKey;
use olympia\items\key\MineKey;
use olympia\items\key\StoreKey;
use olympia\items\key\VoteKey;

// Mythril
use olympia\items\mythril\MythrilSickle;

class Register {

    public static function registerAll(): void {
        self::item();
        self::block();
    }

    private static function item(): void {
        $i = ItemUtils::getInstance();

        /* MYTHRIL */
        $i->register(MythrilSickle::class, "mythril_sickle", "Faucille en mythril");

        /* ARMOR */

        $i->register(MythrilBoots::class, "mythril_boots", "Bottes en mythril");
        $i->register(MythrilLeggings::class, "mythril_leggings", "Jambières en mythril");
        $i->register(MythrilChestplate::class, "mythril_chestplate", "Plastron en mythril");
        $i->register(MythrilHelmet::class, "mythril_helmet", "Casque en mythril");

        $i->register(OrichalqueBoots::class, "orichalque_boots", "Bottes en orichalque");
        $i->register(OrichalqueLeggings::class, "orichalque_leggings", "Jambières en orichalque");
        $i->register(OrichalqueChestplate::class, "orichalque_chestplate", "Plastron en orichalque");
        $i->register(OrichalqueHelmet::class, "orichalque_helmet", "Casque en orichalque");

        /* KEY */
        $i->register(VoteKey::class, "vote_key", "Clé Vote");
        $i->register(EpicKey::class, "epic_key", "Clé Epic");
        $i->register(MineKey::class, "mine_key", "Clé Mine");
        $i->register(ItemKey::class, "item_key", "Clé Item");
        $i->register(StoreKey::class, "store_key", "Clé Boutique");
        $i->register(CosmeticKey::class, "cosmetic_key", "Clé Cosmétique");
        $i->register(EventKey::class, "event_key", "Clé Evenement");

        /* SPECIAL */
        // $i->register(InfinitySword::class, "infinite_sword", "Epée de l'infinie");
    }

    private static function block(): void {
        $b = BlockUtils::getInstance();
        $b->register(ChunkBuster::class, "Chunk buster", "chunkbuster", "chunk_buster");
    }
}