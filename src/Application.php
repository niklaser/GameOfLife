<?php
namespace GameOfLife;
/**
 * Created by PhpStorm.
 * User: niklase
 * Date: 08/11/2016
 * Time: 13.23
 */
class Application
{
    private $command;

    public function add($gameOfLifeCommand)
    {
        $this->command = $gameOfLifeCommand;
    }

    public function run()
    {
        $command = $this->command;
        $command->fooBar();
    }
}