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

    public function testDrawsEachGeneration() {
      $generations = 123;
      $draw = $this->prophet->prophesize('\GameOfLife\DrawInterface');
      $board = $this->gameEngine->generateBoard($this->width, $this->height);
      $this->gameEngine->setDrawer($draw->reveal());

      $this->gameEngine->run($generations, $board);

      $draw->draw($board)->shouldBeCalledTimes($generations);
      $this->prophet->checkPredictions();
    }

    public function testCalculatesBoardStateForEachGeneration() {
      $board = $this->prophet->prophesize('\GameOfLife\BoardInterface');
      $board2 = $this->prophet->prophesize('\GameOfLife\BoardInterface');
      $drawer = $this->prophet->prophesize('\GameOfLife\DrawInterface');
      $newGeneration = $board2->reveal();
      $board->tick()->willReturn($newGeneration);

      $this->gameEngine->setDrawer($drawer->reveal());

      $this->gameEngine->run(1, $board->reveal());

      $drawer->draw($newGeneration)->shouldHaveBeenCalled();
    }


}