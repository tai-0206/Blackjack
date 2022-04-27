<?php

namespace BlackJack;

require_once('BJCard.php');
require_once('BJPlayer.php');
// require_once('BJCpu.php');
require_once('BJDealer.php');

class BJGame
{
    private $bjCard;
    private $player;
    // private array $cpus;
    private $dealer;

    private array $secondDealerCard;
    private array $playerCardNumbers;
    private array $dealerCardNumbers;
    // private array $cpuCardNumbers;
    private int $playerHand = 0;
    private int $dealerHand = 0;
    private array $playerResult;
    private array $dealerResult;
    // private array $cpuHands = [
    //     'CUP1' => 0,
    //     'CUP2' => 0,
    // ];

    public function __construct(private int $playerOfNumber)
    {
        $this->bjCard = new BJCard();
        $this->player = new BJPlayer();
        // $cpuNumber = 1;
        // for ($i = $playerOfNumber; $i < 2; $i--) {
        //     $cpus['CPU' . $cpuNumber] = new BJCpu();
        //     $cpuNumber++;
        // }
        $this->dealer = new BJDealer();
    }

    public function start()
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        // プレイヤーが2枚カードを引く
        $this->playerCardNumbers[] = $this->drawCard($this->player);
        $this->playerCardNumbers[] = $this->drawCard($this->player);
        // ディーラーが1枚目公開するカード、2枚目非公開のカードを引く
        $this->dealerCardNumbers[] = $this->drawCard($this->dealer);
        $this->secondDealerCard = $this->drawCard($this->dealer);
        $this->dealerCardNumbers[] = $this->secondDealerCard['number'];
        // プレイヤーハンドを取得する
        $this->playerHand = $this->getHand($this->playerCardNumbers, $this->playerHand);
        // ディーラーハンドを取得する
        $this->dealerHand = $this->getHand($this->dealerCardNumbers, $this->dealerHand);
        // プレイヤーはヒットかスタンドする
        $this->playerResult = $this->hitOrStand($this->player, $this->playerHand);
        //　ディーラーはハンドが17以上になるまでカードを引く
        echo 'ディーラーの引いた2枚目のカードは' . $this->secondDealerCard['suit'] . 'の' . $this->secondDealerCard['number'] . 'でした。' . PHP_EOL;
        $this->dealerResult = $this->hitOrStand($this->dealer, $this->dealerHand);
        // 勝者を決める
        $this->getWinner($this->playerResult, $this->dealerResult);
    }

    public function drawCard(BJPerson $person)
    {
        return $person->drawCard();
    }

    public function getHand(array $cardNumbers, int $hand): int
    {
        $currentHand = $hand;
        foreach ($cardNumbers as $cardNumber) {
            $rank = $this->bjCard->getRank($cardNumber);
            if ($cardNumber === 'A' && $hand <= 11) {
                $rank = 11;
            }
            $currentHand += $rank;
        }
        return $currentHand;
    }

    public function hitOrStand(BJperson $person, int $hand): array
    {
        return $person->hitOrStand($hand);
    }

    public function getWinner(array $playerResult, array $dealerResult): void
    {
        echo 'あなたの得点は' . $playerResult['hand'] . 'です。' . PHP_EOL;
        echo 'ディーラーの得点は' . $dealerResult['hand'] . 'です。' . PHP_EOL;
        $playerIsBurst = ($playerResult['is_burst'] === 'Y');
        $dealerIsBurst = ($dealerResult['is_burst'] === 'Y');
        $playerHandHigher = ($playerResult['hand'] > $dealerResult['hand']);
        $dealerHandHigher = ($playerResult['hand'] < $dealerResult['hand']);

        if ($playerIsBurst) {
            echo 'あなたの負けです！' . PHP_EOL;
        }

        if ((!$playerIsBurst) && $dealerIsBurst) {
            echo 'あなたの勝ちです！' . PHP_EOL;
        }

        if ((!$playerIsBurst) && $playerHandHigher) {
            echo 'あなたの勝ちです！' . PHP_EOL;
        }

        if ((!$dealerIsBurst) && $dealerHandHigher) {
            echo 'あなたの負けです！' . PHP_EOL;
        }

        if ((!$playerIsBurst) && (!$dealerIsBurst) && $playerResult['hand'] === $dealerResult['hand']) {
            echo '引き分けです。' . PHP_EOL;
        }
        echo 'ブラックジャックを終了します' . PHP_EOL;
    }
}
