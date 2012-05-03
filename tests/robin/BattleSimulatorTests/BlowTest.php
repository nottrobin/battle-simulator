<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

abstract class BlowTest extends PHPUnit_Framework_TestCase {
    protected $strength = 70;

    public function setUp() {
        $this->blow = $this->getBlow($this->strength);
    }
    
    /**
     * @test
     * @covers Blow::getBlowStrength
     */
    public function canGetBlowStrength() {
        $this->assertEquals($this->strength, $this->blow->getStrength());
    }
}

