<?php

namespace olympia;

use olympia\blocks\BlockUtils;
use olympia\blocks\ChunkBuster;
use olympia\items\ItemUtils;

// Key
use olympia\items\key\CosmetiqueKey;
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

        /* KEY */
        $i->register(VoteKey::class, "vote_key", "Clé Vote");
        $i->register(EpicKey::class, "epic_key", "Clé Epic");
        $i->register(MineKey::class, "mine_key", "Clé Mine");
        $i->register(ItemKey::class, "item_key", "Clé Item");
        $i->register(StoreKey::class, "store_key", "Clé Boutique");
        $i->register(CosmetiqueKey::class, "cosmetique_key", "Clé Cosmétique");
        $i->register(EventKey::class, "event_key", "Clé Evenement");
    }

    private static function block(): void {
        $b = BlockUtils::getInstance();
        $b->register(ChunkBuster::class, "Chunk buster", 2, "chunkbuster", "chunk_buster");
    }
}