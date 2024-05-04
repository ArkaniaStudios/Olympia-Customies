<?php

namespace olympia\utils;

use olympia\Customies;
use pocketmine\scheduler\ClosureTask;

class PlayerCooldowns
{
    const COOLDOWN_PEARL = 0;
    const COOLDOWN_DASH = 1;
    const COOLDOWN_STICKANTIPEARL = 2;
    const COOLDOWN_STICKANTIBUILD = 3;
    const COOLDOWN_STICKINFERNAL = 4;
    const COOLDOWN_ROCKET = 5;
    const COOLDOWN_LEVITATION = 6;
    const COOLDOWN_FORCE = 7;
    const COOLDOWN_RESISTANCE = 8;
    const COOLDOWN_EGGSTRAP = 9;
    const COOLDOWN_SNOWBALL = 10;
    const COOLDOWN_PORTALTP = 11;
    const COOLDOWN_COMMANDSTUFF = 12;
    const COOLDOWN_KITJOUEUR = 13;
    const COOLDOWN_KITREFILL = 14;
    const COOLDOWN_KITOUTILS = 15;
    const COOLDOWN_KITANGES = 16;
    const COOLDOWN_KITDIABLOTINS = 17;
    const COOLDOWN_KITARCHANGES = 18;
    const COOLDOWN_KITPERSEPHONE = 19;
    const COOLDOWN_KITPOSEIDON = 20;
    const COOLDOWN_KITHECATE = 21;
    const COOLDOWN_KITZEUS = 22;
    const COOLDOWN_KITHADES = 23;
    const COOLDOWN_KITBOOSTER = 24;
    const COOLDOWN_REPAIR = 25;
    const COOLDOWN_REPAIRALL = 26;

    private Player $player;

    private array $cooldownsList = [
        self::COOLDOWN_PEARL => null,
        self::COOLDOWN_DASH => null,
        self::COOLDOWN_STICKANTIPEARL => null,
        self::COOLDOWN_STICKANTIBUILD => null,
        self::COOLDOWN_STICKINFERNAL => null,
        self::COOLDOWN_ROCKET => null,
        self::COOLDOWN_LEVITATION => null,
        self::COOLDOWN_FORCE => null,
        self::COOLDOWN_RESISTANCE => null,
        self::COOLDOWN_EGGSTRAP => null,
        self::COOLDOWN_SNOWBALL => null,
        self::COOLDOWN_PORTALTP => null,
        self::COOLDOWN_COMMANDSTUFF => null,
        self::COOLDOWN_KITJOUEUR => null,
        self::COOLDOWN_KITREFILL => null,
        self::COOLDOWN_KITOUTILS => null,
        self::COOLDOWN_KITANGES => null,
        self::COOLDOWN_KITDIABLOTINS => null,
        self::COOLDOWN_KITARCHANGES => null,
        self::COOLDOWN_KITPERSEPHONE => null,
        self::COOLDOWN_KITPOSEIDON => null,
        self::COOLDOWN_KITHECATE => null,
        self::COOLDOWN_KITZEUS => null,
        self::COOLDOWN_KITHADES => null,
        self::COOLDOWN_KITBOOSTER => null,
        self::COOLDOWN_REPAIR => null,
        self::COOLDOWN_REPAIRALL => null,
    ];

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function getCooldown(int $id): int
    {
        return $this->hasCooldown($id) ? $this->cooldownsList[$id] - time() : 0;
    }

    public function setCooldown(int $id, int $time, string $messageStart = "", string $messageEnd = ""): void
    {
        $this->cooldownsList[$id] = time() + $time;

        if($messageStart !== "") {
            $this->player->sendMessage($messageStart);
        }

        if($messageEnd !== "") {
            Customies::getInstance()->getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($messageEnd): void {
                if($this->player->isOnline()) {
                    $this->player->sendMessage($messageEnd);
                }
            }), $time * 20);
        }
    }

    public function hasCooldown(int $id): bool
    {
        return !is_null($this->cooldownsList[$id]) && $this->cooldownsList[$id] - time() > 0;
    }
}