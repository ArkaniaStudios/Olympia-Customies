<?php

namespace olympia\recipes;

use olympia\blocks\OlympiaBlocks;
use olympia\items\OlympiaItems;
use pocketmine\crafting\ExactRecipeIngredient;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\VanillaItems;
use pocketmine\Server;

class CraftRecipes {

    private array $crafts = [];
    private ExactRecipeIngredient $mythril;
    private ExactRecipeIngredient $orichalque;

    public function __construct() {
        $this->mythril = new ExactRecipeIngredient(OlympiaItems::MYTHRIL_INGOT());
        $this->orichalque = new ExactRecipeIngredient(OlympiaItems::ORICHALQUE_INGOT());
    }

    public function initCraft(): void {
        $this->armorRecipes();
        $this->toolsRecipes();
        $this->blocksRecipes();

        foreach ($this->crafts as $craft) {
            Server::getInstance()->getCraftingManager()->registerShapedRecipe($craft);
        }
    }

    private function armorRecipes(): void {
        $this->crafts[] = new ShapedRecipe(["AAA", "A A"], ["A" => $this->mythril], [OlympiaItems::MYTHRIL_HELMET()]);
        $this->crafts[] = new ShapedRecipe(["A A", "AAA", "AAA"], ["A" => $this->mythril], [OlympiaItems::MYTHRIL_CHESTPLATE()]);
        $this->crafts[] = new ShapedRecipe(["AAA", "A A", "A A"], ["A" => $this->mythril], [OlympiaItems::MYTHRIL_LEGGINGS()]);
        $this->crafts[] = new ShapedRecipe(["A A", "A A"], ["A" => $this->mythril], [OlympiaItems::MYTHRIL_BOOTS()]);

        $this->crafts[] = new ShapedRecipe(["AAA", "A A"], ["A" => $this->orichalque], [OlympiaItems::ORICHALQUE_HELMET()]);
        $this->crafts[] = new ShapedRecipe(["A A", "AAA", "AAA"], ["A" => $this->orichalque], [OlympiaItems::ORICHALQUE_CHESTPLATE()]);
        $this->crafts[] = new ShapedRecipe(["AAA", "A A", "A A"], ["A" => $this->orichalque], [OlympiaItems::ORICHALQUE_LEGGINGS()]);
        $this->crafts[] = new ShapedRecipe(["A A", "A A"], ["A" => $this->orichalque], [OlympiaItems::ORICHALQUE_BOOTS()]);
    }

    private function toolsRecipes(): void {
        $this->crafts[] = new ShapedRecipe(["A", "A", "B"], ["A" => $this->mythril, "B" => VanillaItems::STICK()], [OlympiaItems::MYTHRIL_SWORD()]);
        $this->crafts[] = new ShapedRecipe(["  A", " AA", "B  "], ["A" => $this->mythril, "B" => VanillaItems::STICK()], [OlympiaItems::MYTHRIL_SICKLE()]);
        $this->crafts[] = new ShapedRecipe(["A", "A", "B"], ["A" => $this->orichalque, "B" => VanillaItems::STICK()], [OlympiaItems::ORICHALQUE_SWORD()]);
        $this->crafts[] = new ShapedRecipe(["  A", " AA", "B  "], ["A" => OlympiaBlocks::ORICHALQUE_BLOCK(), "B" => VanillaItems::STICK()], [OlympiaItems::ORICHALQUE_SICKLE()]);
    }

    private function blocksRecipes(): void {
        $this->crafts[] = new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => $this->orichalque], [OlympiaBlocks::ORICHALQUE_BLOCK()]);
    }
}