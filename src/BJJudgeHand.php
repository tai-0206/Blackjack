<?php

namespace BlackJack;

class BJJudgeHand
{
    public function isBurst(int $hand): bool
    {
        if ($hand > 21) {
            return true;
        }
        return false;
    }

    public function isMore17(int $dealerHand): bool
    {
        if ($dealerHand >= 17) {
            return true;
        }
        return false;
    }

    public function getWinner($playerNumber, $dealerNumber): string
    {
        if ($playerNumber > $dealerNumber) {
            return 'あなたの勝ちです!';
        }

        if ($playerNumber < $dealerNumber) {
            return 'あなたの負けです!';
        }
        return '引き分けです';
    }
}
