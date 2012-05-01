<?php

require_once('tests/Combatants/CombatantTest.php');
require_once('lib/Combatants/Brute.php');
require_once('lib/Randomisation/BooleanGenerator.php');

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
        $falseGenerator = new BooleanGenerator(0);

        $attack = $this->weakCombatant->createAttack($falseGenerator);
        $expectedAttack = new Attack($this->weakCombatant->getAttackStrength());
        
        $this->assertInstanceOf('Attack', $attack);
        $this->assertFalse($attack->isStunning());
        $this->assertEquals($expectedAttack, $attack);
    }

    /**
     * @test
     * @covers Brute::createAttack
     */
    public function attackCanBeCreatedWithStunningBlow() {
        $trueGenerator = new BooleanGenerator(1);
        
        $attack = $this->weakCombatant->createAttack($trueGenerator);
        $expectedAttack = new Attack($this->weakCombatant->getAttackStrength());
        $expectedAttack->setStunning(true);

        $this->assertInstanceOf('Attack', $attack);
        $this->assertTrue($attack->isStunning());
        $this->assertEquals($expectedAttack, $attack);
    }
}

