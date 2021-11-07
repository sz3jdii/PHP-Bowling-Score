<?php

namespace Src;

class BowlingScore
{
    /**
     * @var array
     */
    protected array $rolls = array();

    /**
     * @param $pins
     */
    public function roll(int $pins)
    {
        $this->rolls[] = $pins;
    }

    /**
     *
     */
    public function resetScore(): void{
        $this->rolls = array();
    }
    /**
     * @return int|mixed
     */
    public function score(): int
    {
        $score      = 0;
        $frameIndex = 0;

        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($frameIndex)) {
                $score += 10 + $this->strikeBonus($frameIndex);
                $frameIndex++;
            }
            else if ($this->isSpare($frameIndex)) {
                $score += 10 + $this->spareBonus($frameIndex);
                $frameIndex += 2;
            } else {
                $score += $this->sumOfPinsInFrame($frameIndex);
                $frameIndex += 2;
            }
        }
        return $score;
    }

    /**
     * @param int $frameIndex
     * @return bool
     */
    protected function isSpare(int $frameIndex): bool
    {
        return $this->sumOfPinsInFrame($frameIndex) == 10;
    }

    /**
     * @param int $frameIndex
     * @return bool
     */
    protected function isStrike(int $frameIndex): bool
    {
        return isset($this->rolls[$frameIndex]) && $this->rolls[$frameIndex] == 10;
    }

    /**
     * @param int $frameIndex
     * @return mixed
     */
    protected function sumOfPinsInFrame(int $frameIndex): int
    {
        $currentScore = isset($this->rolls[$frameIndex]) ? $this->rolls[$frameIndex] : 0;
        $nextScore = isset($this->rolls[$frameIndex + 1]) ? $this->rolls[$frameIndex + 1] : 0;
        return $currentScore + $nextScore;
    }

    /**
     * @param int $frameIndex
     * @return mixed
     */
    protected function spareBonus(int $frameIndex): int
    {
        return $this->rolls[$frameIndex + 2];
    }

    /**
     * @param int $frameIndex
     * @return mixed
     */
    protected function strikeBonus(int $frameIndex): int
    {
        $nextScore = isset($this->rolls[$frameIndex + 1]) ? $this->rolls[$frameIndex + 1] : 0;
        $nextSecondScore = isset($this->rolls[$frameIndex + 2]) ? $this->rolls[$frameIndex + 2] : 0;
        return $nextScore + $nextSecondScore;
    }
}