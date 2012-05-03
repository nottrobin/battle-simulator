<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/BattleSimulator/Brute.php');
require_once('tests/robin/BattleSimulatorTests/CombatantTest.php');
require_once('lib/robin/Random/Randomiser.php');

class BruteTest extends CombatantTest {
    protected $attributes = array(
        'health'   => ['lower' => 90,  'upper' => 100],
        'strength' => ['lower' => 65,  'upper' => 75],
        'defence'  => ['lower' => 40,  'upper' => 50],
        'speed'    => ['lower' => 40,  'upper' => 65],
        'luck'     => ['lower' => 0.3, 'upper' => 0.35]
    );

    protected function createCombatant($randomiser = null) {
        return new Brute($randomiser);
    }

    /**
     * @test
     * @covers Brute::createAttack
     */
    public function canAttack() {
        $zeroRandomiser = new Randomiser(0);

        $attack = $this->weakCombatant->createAttack($zeroRandomiser);
        $expectedAttack = new Attack($this->weakCombatant->getStrength());
        
        $this->assertInstanceOf('Attack', $attack);
        $this->assertFalse($attack->isStunning());
        $this->assertEquals($expectedAttack, $attack);
    }

    /**
     * @test
     * @covers Brute::createAttack
     */
    public function attackCanBeCreatedWithStunningBlow() {
        $oneRandomiser = new Randomiser(1);
        
        $attack = $this->weakCombatant->createAttack($oneRandomiser);
        $expectedAttack = new Attack($this->weakCombatant->getStrength());
        $expectedAttack->setStunning(true);

        $this->assertInstanceOf('Attack', $attack);
        $this->assertTrue($attack->isStunning());
        $this->assertEquals($expectedAttack, $attack);
    }
}

