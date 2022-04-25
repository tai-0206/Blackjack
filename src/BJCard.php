<?php

namespace BlackJack;

class BJCard
{
    const CARD_RANKS = [
        'A' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
    ];

    public function __construct()
    {
    }

    public function getRank($cardNumber): int
    {
        return self::CARD_RANKS[$cardNumber];
    }
}
