<?php
use Prophecy\Argument;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Created by PhpStorm.
 * User: akis
 * Date: 15/11/16
 * Time: 14:22
 */
class GameOfLifeCommandTest extends PHPUnit_Framework_TestCase
{
    private $prophet;

    private $gameOfLifeCommand;

    private $gameOfLifeCommand1;

    private $input;

    private $output;

    private $engine;

    private $seed = 'this should be seed';

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass(); // TODO: Change the autogenerated stub
        $loader = new \Symfony\Component\ClassLoader\Psr4ClassLoader();
        $loader->addPrefix('GameOfLife', __DIR__ . '/../src');
        $loader->addPrefix('Test', __DIR__ );
        $loader->register();
    }

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->prophet = new Prophecy\Prophet;

        $board = $this->prophet->prophesize();
        $board->willImplement('\GameOfLife\BoardInterface');

        $stuff = $this->prophet->prophesize();
        $stuff->willExtend('\GameOfLife\GameEngine');
        $stuff->generateBoard(100,100)->willReturn($board->reveal());
        $stuff->run()->willReturn(Argument::any());
        $this->engine = $stuff;

        $input = $this->prophet->prophesize();
        $input->willImplement('\Symfony\Component\Console\Input\InputInterface');
        $input->getOption(Argument::type('string'))->willReturn(null);
        $this->input = $input;

        $output = $this->prophet->prophesize();
        $output->willImplement('\Symfony\Component\Console\Output\OutputInterface');
        $this->output = $output->reveal();

        $this->gameOfLifeCommand = new \Test\GameOfLifeCommandStub($stuff->reveal());

    }


    public function testUsesDefaultParameters() {
        // Arrange
        $this->engine->generateBoard(100,100)->shouldBeCalled();

        // Act
        $this->gameOfLifeCommand->testExecute($this->input->reveal(), $this->output);

        // Assert
        $this->prophet->checkPredictions();
    }

    public function testSeed() {
        // Arrange
        $this->input->getOption('width')->willReturn(300);
        $this->input->getOption('height')->willReturn(100);
        $this->input->getOption('seed')->willReturn($this->seed);
        $board = $this->prophet->prophesize();
        $board->willImplement('\GameOfLife\BoardInterface');
        $this->engine->generateBoard(300,100)->willReturn($board);
        $board->setSeed($this->seed)->shouldBeCalled();

        // Act
        $this->gameOfLifeCommand->testExecute($this->input->reveal(), $this->output);

        // Assert
        $this->prophet->checkPredictions();

    }

    public function testLoopIsStarted() {
        // Arrange

        // Act
        $this->gameOfLifeCommand->testExecute($this->input->reveal(), $this->output);

        // Assert
        $this->engine->run()->shouldHaveBeenCalled();
    }
}
