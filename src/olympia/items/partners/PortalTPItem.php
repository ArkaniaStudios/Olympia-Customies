<?php

namespace olympia\items\partners;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use olympia\Customies;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\world\sound\BellRingSound;

class PortalTPItem extends Item implements ItemComponents {
    use ItemComponentsTrait;


    public function __construct(ItemIdentifier $identifier, string $name = "Unknown", array $enchantmentTags = []) {
        parent::__construct($identifier, $name, $enchantmentTags);
        $creative = new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS);
        $this->initComponent("portal_item", $creative);
        $this->setLore([
            "§rPour tp un joueur qui vous a tapé les §e10§r dernières secondes.",
        ]);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $errMessage = "§6» §fAucun joueur ne vous a tapé dans ces 10 dernières secondes.";
        $cause = $player->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent) {
            $damager = $cause->getDamager();
            if($damager instanceof Player) {
                if(time() - $player->getLastAttackedTime() <= 10) {

                    $player->sendPopup("§6» §fVous venez d'utiliser l'item §6Portail TP");
                    $player->sendPopup("§6» §fVous allez être téléporté sur §6{$damager->getName()} §fdans §63 secondes");
                    $damager->sendPopup("§6» §6{$player->getName()} §fva être téléporté sur vous dans §63 secondes");
                    $player->getInventory()->setItemInHand($player->getInventory()->getItemInHand()->setCount($player->getInventory()->getItemInHand()->getCount() - 1));
                    $scheduler = Customies::getInstance()->getScheduler();
                    $scheduler->scheduleDelayedTask(new ClosureTask(function () use ($player, $damager): void {
                        $player->teleport($damager->getPosition());
                    }), 60);
                }else{
                    $player->sendPopup($errMessage);
                    $player->broadcastSound(new BellRingSound());
                }
            }else{
                $player->sendPopup($errMessage);
                $player->broadcastSound(new BellRingSound());
            }
        }else{
            $player->sendPopup($errMessage);
            $player->broadcastSound(new BellRingSound());
        }
        return ItemUseResult::SUCCESS();
    }
}
