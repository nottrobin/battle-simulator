<?php

require_once('lib/robin/BattleSimulator/TextGenerator.php');
require_once('lib/robin/Random/Randomiser.php');

class TextGeneratorTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $this->zeroRandomiser = new Randomiser(0);
        $this->oneRandomiser = new Randomiser(1);
        $this->firstGenerator = new TextGenerator($this->zeroRandomiser);
        $this->lastGenerator = new TextGenerator($this->oneRandomiser);
    }

    /**
     * @test
     * @covers TextGenerator::gertVerb
     */
    public function canGetVerb() {
        $this->assertEquals('flung', $this->firstGenerator->getVerb());
        $this->assertEquals('nudged', $this->lastGenerator->getVerb());
    }

    /**
     * @test
     * @covers TextGenerator::getWeaponAdjective
     */
    public function canGetWeaponAdjective() {
        $this->assertEquals('a whirling', $this->firstGenerator->getWeaponAdjective());
        $this->assertEquals('an ice cold', $this->lastGenerator->getWeaponAdjective());
    }

    /**
     * @test
     * @covers TextGenerator::getDodgeAdjective
     */
    public function canGetDodgeAdjective() {
        $this->assertEquals('an illegal', $this->firstGenerator->getDodgeAdjective());
        $this->assertEquals('a totally believable', $this->lastGenerator->getDodgeAdjective());
    }

    /**
     * @test
     * @covers TextGenerator::getNoun
     */
    public function canGetNoun() {
        $this->assertEquals('fish', $this->firstGenerator->getNoun());
        $this->assertEquals('pen', $this->lastGenerator->getNoun());
    }

    /**
     * @test
     * @covers TextGenerator::getAppendix
     */
    public function canGetAppendix() {
        $this->assertEquals('death', $this->firstGenerator->getAppendix());
        $this->assertEquals('oblivion', $this->lastGenerator->getAppendix());
    }

    /**
     * @test
     * @covers TextGenerator::getAbstractNoun
     */
    public function canGetAbstractNoun() {
        $this->assertEquals('bravery', $this->firstGenerator->getAbstractNoun());
        $this->assertEquals('derision', $this->lastGenerator->getAbstractNoun());
    }
}

