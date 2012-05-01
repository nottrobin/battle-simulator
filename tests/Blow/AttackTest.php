<?php

include_once('lib/Blow/BlowFactory.php');
include_once('tests/Blow/BlowTest.php');

class AttackTest extends BlowTest {
    private $retaliationStrength = 10; 

    protected function getBlow($strength) {
        return (new BlowFactory())->createAttack($strength);
    }

    /**
     * @test
     * @covers Attack::isStunning
     */
    public function canRetrieveStunningStatus() {
        $this->assertFalse($this->blow->isStunning());
        $this->blow->setStunning(true);
        $this->assertTrue($this->blow->isStunning());
        $this->blow->setStunning(false);
        $this->assertFalse($this->blow->isStunning());
    }
    
    /**
     * @test
     * @covers Attack::SetCounterAttackDamage
     * @covers Attack::getCounterAttackDamage
     */
    public function canSetAndGetRetaliation() {
        $retaliation = (new BlowFactory())->createRetaliation($this->retaliationStrength);
        $this->assertNull($this->blow->getRetaliation());
        $this->assertTrue($this->blow->setRetaliation($retaliation));
        $this->assertEquals($this->retaliationStrength, $this->blow->getRetaliation()->getStrength());
    }
    
    /**
     * @test
     * @covers Attack::missed
     */
    public function canSetAttackMissed() {
        $this->assertFalse($this->blow->hasMissed());
        $this->assertTrue($this->blow->missed());
        $this->assertTrue($this->blow->hasMissed());
        $this->assertEquals(0, $this->blow->getDamage());
    }
}

