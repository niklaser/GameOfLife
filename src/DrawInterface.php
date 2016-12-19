<?php

namespace GameOfLife;

interface DrawInterface
{
    public function draw(BoardInterface $board);
}