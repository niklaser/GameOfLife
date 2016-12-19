<?php

class BoardTest extends PHPUnit_Framework_TestCase
{
    public function testTickReturnsEmptyBoardWhenSeedHasASingeCelAlive() {
        $seed = [[1,1]];
        $board = new \GameOfLife\Board();
        $board->setSeed($seed);

        $newGeneration = $board->tick();
        $cells = $newGeneration->getLiveCells();

        $this->assertEmpty($cells);
    }
}