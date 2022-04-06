<?php

namespace BlackJack;

interface BJPerson
{
    public function drawCard();
    public function hitOrStand(int $hand);
}
