<?php
namespace Test;
/**
 * Created by PhpStorm.
 * User: akis
 * Date: 15/11/16
 * Time: 14:42
 */
class GameOfLifeCOmmandStubb extends \GameOfLife\Command\GameOfLifeCommand
{
    public $stuff;

    public function __construct($stuff)
    {
        $name = 'nimi';
        $this->stuff = $stuff;
        parent::__construct($name);
    }

    protected function getStuff()
    {
        $stuff = $this->stuff;
        return $stuff;
    }

    public function testExecute($input, $output) {
        parent::execute($input,$output);
    }

}