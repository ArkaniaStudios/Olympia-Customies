<?php

namespace olympia;

use olympia\blocks\BlockUtils;
use olympia\blocks\ChunkBuster;
use olympia\items\ItemUtils;
use olympia\items\Sickle;

class Register {

    public static function registerAll(): void {
        (new Register)->item();
        (new Register)->block();
    }

    private function item(): void {
        $i = ItemUtils::getInstance();
        $i->register(Sickle::class, "sickle", "Faucille");
    }

    private function block(): void {
        $b = BlockUtils::getInstance();
        $b->register(ChunkBuster::class, "Chunk buster", 2, "chunkbuster", "chunk_buster");
    }
}