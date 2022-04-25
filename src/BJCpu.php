<?php

namespace BlackJack;

require_once('BJDrawCard.php');
require_once('BJCard.php');
require_once('BJPerson.php');

// BJGameでCPUを実装する際に使用
// 自分以外はCPUが操作
        // if ($this->playerOfNumber > 1) {
        //     foreach ($this->cpus as $cpu) {
        //         $this->cpuHands[$cpu->cpuName] += $this->drawCard($cpu);
        //         $this->cpuHands[$cpu->cpuName] += $this->drawCard($cpu);
        //     }
        // }

class BJCpu implements BJPerson
{
    public $cpuHand = 0;

    public function drawCard()
    {
        $bjDrawCard = new BJDrawCard();
        $card = $bjDrawCard->drawCard();
        echo $this->cpuName . 'の引いたカードは' . $card['suit'] . 'の' . $card['number'] . 'です。' . PHP_EOL;
        return $card;
    }

    public function hitOrStand($hand)
    {
    }

    public function getRank($cardNumber): int
    {
        $bjCard = new BJCard();
        $this->cpuHand += $bjCard->getRank($cardNumber);
        if ($cardNumber === 'A' && $this->cpuHand <= 11) {
            $this->cpuHand += 10;
        }
        echo $this->cpuName . 'の現在の得点は' . $this->cpuHand . 'です。';
        return $this->cpuHand;
    }
}
