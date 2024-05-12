<?php

namespace olympia\forms;

use nacre\form\class\ModalForm;
use pocketmine\block\VanillaBlocks;
use pocketmine\player\Player;
use pocketmine\world\format\Chunk;

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
                        $player->sendMessage("§aVous avez accepté la destruction du chunk !");
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