<?php

namespace olympia\forms;

use nacre\form\class\ModalForm;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use pocketmine\world\particle\ExplodeParticle;
use pocketmine\world\sound\BellRingSound;
use pocketmine\math\Vector3;
use pocketmine\world\Position;
use pocketmine\world\sound\BlockBreakSound;

class FormManager {

    public function chunkBusterValidation(Player $player): void {
        $form = new ModalForm(
            $player,
            ">> Chunk Buster <<",
            "Attention vous vous apprétez à détruire se chunk !\nCeci est une décision irrévocable.",
            "Oui",
            "Non",
            function (Player $player, $data) {
                switch ($data) {
                    case 1:
                        $radius = 7.5;
                        $position = $player->getPosition();
                        $centerX = intval($position->x);
                        $centerZ = intval($position->z);

                        for ($x = $centerX - $radius; $x <= $centerX + $radius; $x++) {
                            for ($y = 1; $y <= 200; $y++) {
                                for ($z = $centerZ - $radius; $z <= $centerZ + $radius; $z++) {
                                    $player->getWorld()->setBlock(new Vector3($x, $y, $z), VanillaBlocks::AIR());
                                    $player->getWorld()->addParticle($position, new ExplodeParticle());
                                }
                            }
                        }

                        $player->sendToastNotification("§6Olympia", "§aVous avez accepté la destruction du chunk !");
                        $player->broadcastSound(new BlockBreakSound(VanillaBlocks::GRASS()));
                        break;
                    case 0:
                        $player->sendToastNotification("§6Olympia", "§aVous avez refusé la destruction du chunk !");
                        break;
                }
            },
        );
        $player->sendForm($form);
    }
}