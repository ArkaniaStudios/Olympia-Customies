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
    private ExactRecipeIngredient $mythrilI;
    private ExactRecipeIngredient $orichalqueI;
    private ExactRecipeIngredient $stick;
    private ExactRecipeIngredient $orichalqueB;

    public function __construct() {
        $this->mythrilI = new ExactRecipeIngredient(OlympiaItems::MYTHRIL_INGOT());
        $this->orichalqueI = new ExactRecipeIngredient(OlympiaItems::ORICHALQUE_INGOT());
        $this->stick = new ExactRecipeIngredient(VanillaItems::STICK());
        $this->orichalqueB = new ExactRecipeIngredient(OlympiaBlocks::ORICHALQUE_BLOCK()->asItem());
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
        $this->crafts[] = new ShapedRecipe(["AAA", "A A"], ["A" => $this->mythrilI], [OlympiaItems::MYTHRIL_HELMET()]);
        $this->crafts[] = new ShapedRecipe(["A A", "AAA", "AAA"], ["A" => $this->mythrilI], [OlympiaItems::MYTHRIL_CHESTPLATE()]);
        $this->crafts[] = new ShapedRecipe(["AAA", "A A", "A A"], ["A" => $this->mythrilI], [OlympiaItems::MYTHRIL_LEGGINGS()]);
        $this->crafts[] = new ShapedRecipe(["A A", "A A"], ["A" => $this->mythrilI], [OlympiaItems::MYTHRIL_BOOTS()]);

        $this->crafts[] = new ShapedRecipe(["AAA", "A A"], ["A" => $this->orichalqueI], [OlympiaItems::ORICHALQUE_HELMET()]);
        $this->crafts[] = new ShapedRecipe(["A A", "AAA", "AAA"], ["A" => $this->orichalqueI], [OlympiaItems::ORICHALQUE_CHESTPLATE()]);
        $this->crafts[] = new ShapedRecipe(["AAA", "A A", "A A"], ["A" => $this->orichalqueI], [OlympiaItems::ORICHALQUE_LEGGINGS()]);
        $this->crafts[] = new ShapedRecipe(["A A", "A A"], ["A" => $this->orichalqueI], [OlympiaItems::ORICHALQUE_BOOTS()]);
    }

    private function toolsRecipes(): void {
        $this->crafts[] = new ShapedRecipe(["A", "A", "B"], ["A" => $this->mythrilI, "B" => $this->stick], [OlympiaItems::MYTHRIL_SWORD()]);
        $this->crafts[] = new ShapedRecipe(["  A", " AA", "B  "], ["A" => $this->mythrilI, "B" => $this->stick], [OlympiaItems::MYTHRIL_SICKLE()]);
        $this->crafts[] = new ShapedRecipe(["A", "A", "B"], ["A" => $this->orichalqueI, "B" => $this->stick], [OlympiaItems::ORICHALQUE_SWORD()]);
        $this->crafts[] = new ShapedRecipe(["  A", " AA", "B  "], ["A" => $this->orichalqueB, "B" => $this->stick], [OlympiaItems::ORICHALQUE_SICKLE()]);
    }

    private function blocksRecipes(): void {
        $this->crafts[] = new ShapedRecipe(["AAA", "AAA", "AAA"], ["A" => $this->orichalqueI], [OlympiaBlocks::ORICHALQUE_BLOCK()->asItem()]);
    }
}