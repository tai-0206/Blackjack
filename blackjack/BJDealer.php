<?php

namespace BlackJack;

require_once('BJDrawCard.php');
require_once('BJPerson.php');

class BJDealer implements BJPerson
{
    private $dealerHand = 0;
    private $drawCount = 1;

    public function drawCard()
    {
        $bjDrawCard = new BJDrawCard();
        $card = $bjDrawCard->drawCard();
        if ($this->drawCount === 2) {
            echo 'ディーラーの引いた2枚目のカードはわかりません。' . PHP_EOL;
            $this->drawCount++;
            return $card;
        }
        echo 'ディーラーの引いたカードは' . $card['suit'] . 'の' . $card['number'] . 'です。' . PHP_EOL;
        $this->drawCount++;
        return $card['number'];
    }

    public function hitOrStand(int $dealerHand): array
    {
        $dealerIsBurst = 'N';
        echo 'ディーラーの現在の得点は' . $dealerHand . 'です。' . PHP_EOL;
        $bjCard = new BJCard();
        while ($dealerHand < 17) {
            $dealerCardNumber = $this->drawCard();
            $dealerHand += $bjCard->getRank($dealerCardNumber);
            if ($this->isBurst($dealerHand)) {
                $dealerIsBurst = 'Y';
                break;
            }
        }
        return [
            'hand' => $dealerHand,
            'is_burst' => $dealerIsBurst
        ];
    }

    public function drawCardUntil17(int $hand): array
    {
        if ($hand <= 17) {
            return $this->drawCard();
        }
    }

    public function isBurst($playerHand): bool
    {
        if ($playerHand > 21) {
            echo 'ディーラーはバーストしました。' . PHP_EOL;
            return true;
        }
        return false;
    }
}
