<?php

namespace BlackJack;

require_once('BJDrawCard.php');
require_once('BJCard.php');
require_once('BJPerson.php');
require_once('BJJudgeHand.php');

class BJPlayer implements BJPerson
{
    public $playerHand = 0;

    public function drawCard()
    {
        $bjDrawCard = new BJDrawCard();
        $card = $bjDrawCard->drawCard();
        echo 'あなたの引いたカードは' . $card['suit'] . 'の' . $card['number'] . 'です。' . PHP_EOL;
        return $card['number'];
    }

    public function hitOrStand(int $playerHand): array
    {
        $playerIsBurst = 'N';
        $bjCard = new BJCard();
        $askDraw = $this->askDraw($playerHand);
        while ($askDraw) {
            $playerCardNumber = $this->drawCard();
            $playerCardRank = $bjCard->getRank($playerCardNumber);
            if ($playerCardNumber === 'A' && $playerHand <= 11) {
                $playerCardRank = 11;
            }
            $playerHand += $playerCardRank;
            if ($this->isBurst($playerHand)) {
                $playerIsBurst = 'Y';
                break;
            }
            $askDraw = $this->askDraw($playerHand);
        }
        return [
            'hand' => $playerHand,
            'is_burst' => $playerIsBurst
        ];
    }

    public function askDraw(int $playerHand): bool
    {
        if ($playerHand < 21) {
            echo 'あなたの現在の得点は' . $playerHand . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            $stdin = trim(fgets(STDIN));
            if ($stdin === 'Y') {
                $askDraw = true;
            } elseif ($stdin === 'N') {
                $askDraw = false;
            }
        } elseif ($playerHand === 21) {
            echo 'ブラックジャックです。' . PHP_EOL;
            return false;
        }
        return $askDraw;
    }

    public function isBurst($playerHand): bool
    {
        if ($playerHand > 21) {
            echo 'あなたはバーストしました。' . PHP_EOL;
            return true;
        }
        return false;
    }
}
