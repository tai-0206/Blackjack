<?php

namespace BlackJack;

class BJDrawCard
{
    private array $cards;

    public function __construct()
    {
        foreach (['クラブ', 'ハート', 'スペード', 'ダイヤ'] as $suit) {
            foreach (['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'] as $number) {
                $this->cards[] =[
                    'suit' => $suit,
                    'number' => $number,
                ];
            }
        }
    }

    public function drawCard()
    {
        $key = array_rand($this->cards, 1);
        return $this->cards[$key];
        // $card = $this->cards[0];
        // return $card;
    }
}
