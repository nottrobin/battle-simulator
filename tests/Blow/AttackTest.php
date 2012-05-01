<?php

include_once('lib/Blow/Blow.php');
include_once('lib/Blow/BlowFactory.php');
include_once('lib/Blow/Attack.php');
include_once('lib/Blow/Retaliation.php');

class AttackTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        // Standard values
        $this->attackStrength      = 70;
        $this->retaliationStrength = 10;
        $this->blowFactory = new BlowFactory();
        // Standard attack
        $this->attack      = $this->blowFactory->createAttack($this->attackStrength);
        // Standard retaliation
        $this->retaliation = $this->blowFactory->createRetaliation($this->retaliationStrength);
    }
    
    /**
     * @test
     * @covers Attack::getDamage
     */
    public function initialDamageIsNull() {
        $this->assertNull($this->attack->getDamage());
    }
    
    /**
     * @test
     * @covers Attack::setDamage
     * @covers Attack::getDamage
     */
    public function canSetAndRetrieveDamage() {
        $damage = 23;
        $this->assertTrue($this->attack->setDamage($damage));
        $this->assertEquals($damage, $this->attack->getDamage());
    }
    
    /**
     * @test
     * @covers Attack::isStunning
     */
    public function canRetrieveStunningStatus() {
        $stunningAttack = new Attack(50, true);
        $this->assertTrue($stunningAttack->isStunning());
        $this->assertFalse($this->attack->isStunning());
    }
    
    /**
     * @test
     * @covers Attack::SetCounterAttackDamage
     * @covers Attack::getCounterAttackDamage
     */
    public function canSetAndGetRetaliation() {
        $this->assertNull($this->attack->getRetaliation());
        $this->assertTrue($this->attack->setRetaliation($this->retaliation));
        $this->assertEquals($this->retaliationStrength, $this->attack->getRetaliation()->getStrength());
    }
    
    /**
     * @test
     * @covers Attack::missed
     */
    public function canSetAttackMissed() {
        $this->assertFalse($this->attack->hasMissed());
        $this->assertTrue($this->attack->missed());
        $this->assertTrue($this->attack->hasMissed());
        $this->assertEquals(0, $this->attack->getDamage());
    }
    
    /**
     * @test
     * @covers Attack::getAttackStrength
     */
    public function canGetAttackStrength() {
        $this->assertEquals($this->attackStrength, $this->attack->getStrength());
    }
    
    /**
     * @test
     * @covers Attack::setKillingBlow
     * @covers Attack::getKillingBlow
     */
    public function canSetAndGetKillingState() {
        $this->assertFalse($this->attack->isKilling());
        $this->attack->setKilling(true);
        $this->assertTrue($this->attack->isKilling());
        $this->attack->setKilling(false);
        $this->assertFalse($this->attack->isKilling());
    }
}

