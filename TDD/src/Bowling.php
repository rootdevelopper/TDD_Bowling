<?php

namespace HelloWorld;


class Bowling {

    private $rolls = array();
    private $gameLength = 21;
    private $currentRoll = 0;

    public function startNewgame() {
        return "Start New Game";
    }

    public function roll($pins){
         $this->rolls[$this->currentRoll ++] = $pins;
    }

    public function score(){

        $score = 0;
        $firstInFrame = 0;

        for($frame = 0; $frame < 10; $frame++ ){
            if($this->isStrike($firstInFrame)){
                list($score, $firstInFrame) = $this->nextTwoBallsForStrike($firstInFrame, $score);
            } else if($this->isSpare($firstInFrame)){
                list($score, $firstInFrame) = $this->nextBallForSpare($firstInFrame, $score);
            } else {
                list($score, $firstInFrame) = $this->twoBallsInFrame($firstInFrame, $score);
            }
        }
        return $score;
    }

    /**
     * @param $firstInFrame
     * @return bool
     */
    public function isSpare($firstInFrame): bool
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1] == 10;
    }

    /**
     * @param $firstInFrame
     * @return bool
     */
    public function isStrike($firstInFrame): bool
    {
        return $this->rolls[$firstInFrame] == 10;
    }

    /**
     * @param $firstInFrame
     * @param $score
     * @return array
     */
    public function nextTwoBallsForStrike($firstInFrame, $score): array
    {
        $score += 10 + $this->rolls[$firstInFrame + 1] + $this->rolls[$firstInFrame + 2];
        $firstInFrame++;
        return array($score, $firstInFrame);
    }

    /**
     * @param $firstInFrame
     * @param $score
     * @return array
     */
    public function nextBallForSpare($firstInFrame, $score): array
    {
        $score += 10 + $this->rolls[$firstInFrame + 2];
        $firstInFrame += 2;
        return array($score, $firstInFrame);
    }

    /**
     * @param $firstInFrame
     * @param $score
     * @return array
     */
    public function twoBallsInFrame($firstInFrame, $score): array
    {
        $score += $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
        $firstInFrame += 2;
        return array($score, $firstInFrame);
    }
}
