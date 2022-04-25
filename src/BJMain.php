<?php

namespace BlackJack;

require_once('BJGame.php');

echo 'プレイ人数を選択してください(1, 2, 3):';
$stdin = trim(fgets(STDIN));
if ($stdin === '1') {
    $game = new BJGame(1);
    $game->start();
} elseif ($stdin === '2') {
    $game = new BJGame(2);
    $game->start();
} elseif ($stdin === '3') {
    $game = new BJGame(3);
    $game->start();
}
