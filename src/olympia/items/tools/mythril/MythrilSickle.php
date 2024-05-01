<?php

namespace olympia\items\tools\mythril;

use customiesdevs\customies\item\component\HandEquippedComponent;
use customiesdevs\customies\item\component\MaxStackSizeComponent;
use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\items\Sickle;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\world\sound\BucketEmptyWaterSound;
use pocketmine\world\sound\FireExtinguishSound;

class MythrilSickle extends Sickle implements ItemComponents {
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("mythril_sickle", $creative);
        $this->addComponent(new HandEquippedComponent());
        $this->addComponent(new MaxStackSizeComponent(1));
        $this->setLore([
            "§rLa faucille en §emythril §rpermet de",
            "§rlabourer la terre en §e3x3",
        ]);
    }

    public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult {
        $inv = $player->getInventory();
        $pos = $blockClicked->getPosition();
        $world = $pos->getWorld();
        $offset = [
            [0, 0, 0],
            [1, 0, 0],
            [-1, 0, 0],
            [0, 0, 1],
            [0, 0, -1],
            [1, 0, 1],
            [1, 0, -1],
            [-1, 0, -1],
            [-1, 0, 1]
        ];
        $crop = [
            [0, 1, 0],
            [1, 1, 0],
            [-1, 1, 0],
            [0, 1, 1],
            [0, 1, -1],
            [1, 1, 1],
            [1, 1, -1],
            [-1, 1, -1],
            [-1, 1, 1]
        ];
        $seed = [
            VanillaItems::POTATO()->getTypeId() => VanillaBlocks::POTATOES(),
            VanillaItems::BEETROOT_SEEDS()->getTypeId() => VanillaBlocks::POTATOES(),
            VanillaItems::CARROT()->getTypeId() => VanillaBlocks::CARROTS(),
            VanillaItems::WHEAT_SEEDS()->getTypeId() => VanillaBlocks::WHEAT(),
        ];

        foreach ($offset as $offsets) {
            $offsetsPos = $pos->add($offsets[0], $offsets[1], $offsets[2]);
            if (in_array($world->getBlock($offsetsPos)->getTypeId(), [VanillaBlocks::GRASS()->getTypeId(), VanillaBlocks::DIRT()->getTypeId()])) {
                $world->setBlock($offsetsPos, VanillaBlocks::FARMLAND());
                $player->broadcastSound(new FireExtinguishSound());
            }
        }

        foreach ($crop as $crops) {
            $farmLandPos = $pos->add($offsets[0], $offsets[1], $offsets[2]);
            $cropsPos = $pos->add($crops[0], $crops[1], $crops[2]);
            if ($world->getBlock($farmLandPos)->getTypeId() == VanillaBlocks::FARMLAND()->getTypeId()) {
                foreach ($inv->getContents() as $item) {
                    if (array_key_exists($item->getTypeId(), $seed)) {
                        $world->setBlock($cropsPos, $seed[$item->getTypeId()]);
                        $player->broadcastSound(new FireExtinguishSound());
                    }
                }
            }
        }

        return ItemUseResult::SUCCESS();
    }
}