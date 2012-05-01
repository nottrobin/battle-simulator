<?php

require_once('tests/Combatants/CombatantTest.php');
require_once('lib/Combatants/Swordsman.php');
require_once('lib/Randomisation/BooleanGenerator.php');

class SwordsmanTest extends CombatantTest {
    protected $attributes = array(
        'health'   => ['lower' => 40,  'upper' => 60],
        'strength' => ['lower' => 60,  'upper' => 70],
        'defence'  => ['lower' => 20,  'upper' => 30],
        'speed'    => ['lower' => 90,  'upper' => 100],
        'luck'     => ['lower' => 0.3, 'upper' => 0.5]
    );


    protected function createCombatant($randomiser = null) {
        return new Swordsman($randomiser);
    }

    /**
     * @test
     * @covers Swordsman::getStrength
     */
    public function attackDoublesSometimes() {
        $trueGenerator  = new BooleanGenerator(1);
        
        $weakAttack   = $this->weakCombatant->getAttackStrength($trueGenerator);
        $strongAttack = $this->strongCombatant->getAttackStrength($trueGenerator);
        $randomAttack = $this->randomCombatant->getAttackStrength($trueGenerator);

        $this->assertEquals($this->attributes['strength']['lower'] * 2, $weakAttack);
        $this->assertEquals($this->attributes['strength']['upper'] * 2, $strongAttack);
        $this->assertLessThanOrEqual($this->attributes['strength']['upper'] * 2, $randomAttack);
        $this->assertGreaterThanOrEqual($this->attributes['strength']['lower'] * 2, $randomAttack);
    }

    /**
     * We need to override this for Swordsman to pass the $falseGenerator
     * to make sure attack is never doubled (that comes in the next test)
     * 
     * @test
     * @covers Combatant::getStrength
     */
    public function strengthIsBetweenParameters() {
        $falseGenerator = new BooleanGenerator(0);

        $weakAttack   = $this->weakCombatant->getAttackStrength($falseGenerator);
        $strongAttack = $this->strongCombatant->getAttackStrength($falseGenerator);
        $randomAttack = $this->randomCombatant->getAttackStrength($falseGenerator);

        $this->assertEquals($this->attributes['strength']['lower'], $weakAttack);
        $this->assertEquals($this->attributes['strength']['upper'], $strongAttack);
        $this->assertLessThanOrEqual($this->attributes['strength']['upper'], $randomAttack);
        $this->assertGreaterThanOrEqual($this->attributes['strength']['lower'], $randomAttack);
    }

    /**
     * We need to override this for Swordsman to pass the $falseGenerator
     * to make sure attack is never doubled (that comes in the next test)
     *
     * @test
     * @covers Combatant::createAttack
     */
    public function canAttack() {
        $falseGenerator = new BooleanGenerator(0);

        $attack = $this->weakCombatant->createAttack();
        $expectedAttack = new Attack($this->weakCombatant->getAttackStrength($falseGenerator));
        
        $this->assertInstanceOf('Attack', $attack);
        
        $this->assertEquals($expectedAttack, $attack);
    }
}

