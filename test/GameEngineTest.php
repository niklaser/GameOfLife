<?php

class GameEngineTest extends PHPUnit_Framework_TestCase
{

/**
 * @var \GameOfLife\GameEngine
 */
    private $gameEngine;

    protected function setUp()
    {
        $this->gameEngine = new \GameOfLife\GameEngine();
    }

    public function testGeneratedBoard() {
        // Arrange
        $width = 300;
        $height = 100;
        $board = $this->gameEngine->generateBoard($width, $height);

        // Act
        // Assert
        $this->assertInstanceOf('\GameOfLife\BoardInterface', $board);
    }
}