<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

abstract class BlowTest extends PHPUnit_Framework_TestCase {
    protected $strength = 70;

    public function setUp() {
        $this->blow = $this->getBlow($this->strength);
    }
    
    /**
     * @test
     * @covers Blow::getDamage
     */
    public function initialDamageIsNull() {
        $this->assertNull($this->blow->getDamage());
    }
    
    /**
     * @test
     * @covers Blow::setDamage
     * @covers Blow::getDamage
     */
    public function canSetAndRetrieveDamage() {
        $damage = 23;
        $this->assertTrue($this->blow->setDamage($damage));
        $this->assertEquals($damage, $this->blow->getDamage());
    }
    
    /**
     * @test
     * @covers Blow::getBlowStrength
     */
    public function canGetBlowStrength() {
        $this->assertEquals($this->strength, $this->blow->getStrength());
    }
    
    /**
     * @test
     * @covers Blow::setKillingBlow
     * @covers Blow::getKillingBlow
     */
    public function canSetAndGetKillingState() {
        $this->assertFalse($this->blow->isKilling());
        $this->blow->setKilling(true);
        $this->assertTrue($this->blow->isKilling());
        $this->blow->setKilling(false);
        $this->assertFalse($this->blow->isKilling());
    }
}

