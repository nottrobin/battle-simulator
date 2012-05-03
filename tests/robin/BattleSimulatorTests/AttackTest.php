<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('tests/robin/BattleSimulatorTests/BlowTest.php');
require_once('lib/robin/BattleSimulator/BlowFactory.php');

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

