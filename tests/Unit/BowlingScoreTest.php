<?php

namespace Tests\Unit;

require_once __DIR__.'/../../src/BowlingScore.php';

use Src\BowlingScore;

use PHPUnit\Framework\TestCase;

class BowlingScoreTest extends TestCase
{
    protected BowlingScore $game;

    protected function setUp(): void
    {
        $this->game = new BowlingScore();
    }

    protected function rollMany($n, $pins)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->game->roll($pins);
        }
    }

    protected function rollSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    protected function rollStrike()
    {
        $this->game->roll(10);
    }

    public function testScoreForGutterGameIs0()
    {
        $this->rollMany(20, 0);
        $this->assertEquals(0, $this->game->score());
    }

    public function testScoreForAllOnesIs20()
    {
        $this->rollMany(20, 1);
        $this->assertEquals(20, $this->game->score());
    }

    public function testScoreForOneSpareFollowedBy3Is16()
    {
        $this->rollSpare();
        $this->game->roll(3);
        $this->rollMany(17, 0);
        $this->assertEquals(16, $this->game->score());
    }

    public function testScoreForOneStrikeFollowedBy3And4Is24()
    {
        $this->rollStrike();
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(17, 0);
        $this->assertEquals(24, $this->game->score());
    }

    public function testScoreForPerfectGameIs300()
    {
        $this->rollMany(12, 10);
        $this->assertEquals(300, $this->game->score());
    }
}