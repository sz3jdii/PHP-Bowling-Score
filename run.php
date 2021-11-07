<?php

require_once __DIR__.'/src/BowlingScore.php';

use Src\BowlingScore;

new Run();

class Run{
    protected BowlingScore $gameEngine;

    public function __construct(){
        $this->gameEngine = new BowlingScore();
        $this->playGame();
    }
    protected function playGame(){
        $rollsP1 = [3, 0, 6, 9, 10, 5, 2, 1, 8, 5];
        echo "Player 1\n";
        echo "+-------+-------+-------+-------+-------+-------+-------+-------+-------+-----------+\n";
        foreach($rollsP1 as $roll){
            $this->gameEngine->roll($roll);
            echo $this->gameEngine->score().'       ';
        }
        echo "\n+-------+-------+-------+-------+-------+-------+-------+-------+-------+-----------+\n\n";
        $this->gameEngine->resetScore();
        $rollsP2 = [2, 1, 3, 4, 9, 10, 2, 1, 3, 5];
        echo "Player 2\n";
        echo "+-------+-------+-------+-------+-------+-------+-------+-------+-------+-----------+\n";
        foreach($rollsP2 as $roll){
            $this->gameEngine->roll($roll);
            echo $this->gameEngine->score().'       ';
        }
        echo "\n+-------+-------+-------+-------+-------+-------+-------+-------+-------+-----------+\n\n";
    }
}

