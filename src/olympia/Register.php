<?php

namespace olympia;

use olympia\blocks\BlockUtils;
use olympia\blocks\ChunkBuster;
use olympia\items\ItemUtils;
use olympia\items\mythril\MythrilSickle;

class Register {

    public static function registerAll(): void {
        self::item();
        self::block();
    }

    private static function item(): void {
        $i = ItemUtils::getInstance();
        $i->register(MythrilSickle::class, "mythril_sickle", "Faucille en mythril");
    }

    private static function block(): void {
        $b = BlockUtils::getInstance();
        $b->register(ChunkBuster::class, "Chunk buster", 2, "chunkbuster", "chunk_buster");
    }
}