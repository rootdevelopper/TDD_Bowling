<?php

namespace HelloWorld\Tests;

use HelloWorld\Bowling;
use PHPUnit\Framework\TestCase;

class BowlingTest extends TestCase {

    public function rollMany($tries, $pins, $Bowling): void
    {
        for ($i = 0; $i < $tries; ++$i) {
            $Bowling->roll($pins);
        }
    }

    /**
     * @param $Bowling
     */
    public function rollSpare($Bowling): void
    {
        $Bowling->roll(5);
        $Bowling->roll(5);
    }

    /**
     * @param $Bowling
     */
    public function rollStrike($Bowling): void
    {
        $Bowling->roll(10);
    }


    public function testBowling() {
        $Bowling = new Bowling();
        $this->assertEquals('Start New Game',$Bowling->startNewgame());
    }

    public function testRoll(){
        $Bowling = new Bowling();
        $this->assertEquals(0  , $Bowling->roll(0));
    }

    public function testGutter()
    {
        $Bowling = new Bowling();
        $tries = 20;
        $pins = 0;
        $this->rollMany($tries, $pins, $Bowling);
        $this->assertEquals(0, $Bowling->score());
    }

    public function testAllOnes(){
        $tries = 20;
        $pins = 1;
        $Bowling = new Bowling();
        $this->rollMany($tries, $pins, $Bowling);
        $this->assertEquals(20, $Bowling->score());
    }

    public function testOneSpare(){
        $tries = 17;
        $pins = 0;
        $Bowling = new Bowling();
        $this->rollSpare($Bowling);
        $Bowling->roll(3);
        $this->rollMany($tries, $pins, $Bowling);
        $this->assertEquals(16, $Bowling->score());
    }

    public function testOneStrike(){
        $tries = 16;
        $pins = 0;
        $Bowling = new Bowling();
        $this->rollStrike($Bowling);
        $Bowling->roll(3);
        $Bowling->roll(4);
        $this->rollMany($tries, $pins, $Bowling);
        $this->assertEquals(24, $Bowling->score());
    }

    public function testPerfectGame(){
        $tries = 21;
        $pins = 10;
        $Bowling = new Bowling();
        $this->rollMany($tries, $pins, $Bowling);
        $this->assertEquals(300, $Bowling->score());
    }

}

