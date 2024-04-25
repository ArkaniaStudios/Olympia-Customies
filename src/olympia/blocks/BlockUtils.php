<?php

namespace olympia\blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\math\Vector3;
use pocketmine\utils\SingletonTrait;

class BlockUtils {
    use SingletonTrait;

    public function register(
        $class,
        string $name,
        string $identifier,
        string $texture,
        int $ghost = 0,
        string $geometry = "geometry.basic",
        $category = CreativeInventoryInfo::CATEGORY_ALL,
        $group = CreativeInventoryInfo::NONE
    ): void {
        $id = BlockTypeIds::newId();
        CustomiesBlockFactory::getInstance()->registerBlock(
            static fn() => new $class(
                new BlockIdentifier($id),
                $name,
                new BlockTypeInfo(new BlockBreakInfo(1))
            ),
            "olympia:" . $identifier,
            new Model([new Material(
                Material::TARGET_ALL,
                $texture,
                Material::RENDER_METHOD_ALPHA_TEST
            )],
            $geometry,
            new Vector3(-8, 0, -8),
            new Vector3(16, 16, 16)),
            new CreativeInventoryInfo($category, $group)
        );
    }
}