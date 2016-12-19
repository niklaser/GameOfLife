<?php
/**
 * Created by PhpStorm.
 * User: akis
 * Date: 15/11/16
 * Time: 14:51
 */

namespace GameOfLife;


class GameEngine
{
    /**
     * @var DrawInterface
     */
    private $drawer;

    public function setDrawer(DrawInterface $drawer)
    {
        $this->drawer = $drawer;
    }

    public function generateBoard($width, $height) {
      return new Board();
    }

    public function run($generations, $board) {
        for($i = 0; $i < $generations; $i++) {
            $this->drawer->draw($board);
        }
    }
}