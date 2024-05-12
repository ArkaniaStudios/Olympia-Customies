<?php

namespace olympia\forms;

use nacre\form\class\ModalForm;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use pocketmine\world\sound\BellRingSound;
use pocketmine\math\Vector3;

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
                            for ($y = 1; $y <= 100; $y++) {
                                for ($z = $centerZ - $radius; $z <= $centerZ + $radius; $z++) {
                                    $player->getWorld()->setBlock(new Vector3($x, $y, $z), VanillaBlocks::AIR());
                                }
                            }
                        }

                        $player->sendMessage("§aVous avez accepté la destruction des blocs autour de vous !");
                        $player->broadcastSound(new BellRingSound());
                        break;
                    case 0:
                        $player->sendMessage("§cVous avez annulé la destruction du chunk !");
                        break;
                }
            },
        );
        $player->sendForm($form);
    }
}