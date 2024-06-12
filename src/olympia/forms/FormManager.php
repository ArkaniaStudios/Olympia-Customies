<?php

namespace olympia\forms;

use nacre\form\class\ModalForm;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use pocketmine\math\Vector3;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\sound\BlockBreakSound;
use pocketmine\world\World;

class FormManager {

    public function chunkBusterValidation(Player $player): void {
        $form = new ModalForm(
            $player,
            ">> Chunk Buster <<",
            "Attention vous vous apprétez à détruire ce chunk !\nCeci est une décision irrévocable.",
            "Oui",
            "Non",
            function (Player $player, $data) {
                if ($data) {
                    $position = $player->getPosition();
                    $chunkX = $position->getFloorX() >> 4;
                    $chunkZ = $position->getFloorZ() >> 4;

                    $world = $player->getWorld();
                    for ($x = $chunkX << 4; $x < ($chunkX << 4) + 16; $x++) {
                        for ($y = 1; $y <= 200; $y++) {
                            for ($z = $chunkZ << 4; $z < ($chunkZ << 4) + 16; $z++) {
                                $blockPos = new Vector3($x, $y, $z);
                                $world->setBlock($blockPos, VanillaBlocks::AIR());
                                $world->addParticle($blockPos, new ExplodeParticle());
                            }
                        }

                    }

                    $player->sendToastNotification("§6Olympia", "§aVous avez accepté la destruction du chunk !");
                    $player->broadcastSound(new BlockBreakSound(VanillaBlocks::GRASS()), [$player]);
                } else {
                    $player->sendToastNotification("§6Olympia", "§aVous avez refusé la destruction du chunk !");
                }
            }
        );
        $player->sendForm($form);
    }
}