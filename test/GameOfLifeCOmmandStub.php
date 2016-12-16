<?php
namespace Test;

class GameOfLifeCommandStub extends \GameOfLife\Command\GameOfLifeCommand
{
    public $engine;

    public function __construct($stuff)
    {
        $name = 'nimi';
        $this->engine = $stuff;
        parent::__construct($name);
    }

    protected function getEngine()
    {
        $engine = $this->engine;
        return $engine;
    }

    public function testExecute($input, $output) {
        parent::execute($input,$output);
    }

}