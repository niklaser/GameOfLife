<?php

class GameEngineTest extends PHPUnit_Framework_TestCase
{
  private $width = 300;
  private $height = 100;

  /**
 * @var \GameOfLife\GameEngine
 */
    private $gameEngine;
    /** @var  \Prophecy\Prophet */
    private $prophet;

    protected function setUp()
    {
        $this->gameEngine = new \GameOfLife\GameEngine();
        $this->prophet = new \Prophecy\Prophet();
    }

    public function testGeneratedBoard() {
        // Arrange
      $board = $this->gameEngine->generateBoard($this->width, $this->height);

        // Act
        // Assert
        $this->assertInstanceOf('\GameOfLife\BoardInterface', $board);
    }

    public function testRuns() {
      $generations = 123;
      $draw = $this->prophet->prophesize('\GameOfLife\DrawInterface');
      $board = $this->gameEngine->generateBoard($this->width, $this->height);
      $this->gameEngine->setDrawer($draw->reveal());
      $this->gameEngine->run($generations, $board);



      $draw->draw($board)->shouldBeCalledTimes($generations);
      $this->prophet->checkPredictions();
    }
}