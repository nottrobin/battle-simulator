<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('tests/robin/BattleSimulatorTests/CombatantTest.php');
require_once('lib/robin/BattleSimulator/Swordsman.php');
require_once('lib/robin/Random/Randomiser.php');

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
        $oneRandomiser = new Randomiser(1);
        
        $weakAttack   = $this->weakCombatant->createAttack($oneRandomiser);
        $strongAttack = $this->strongCombatant->createAttack($oneRandomiser);
        $randomAttack = $this->randomCombatant->createAttack($oneRandomiser);

        $this->assertEquals($this->attributes['strength']['lower'] * 2, $weakAttack->getStrength());
        $this->assertEquals($this->attributes['strength']['upper'] * 2, $strongAttack->getStrength());
        $this->assertLessThanOrEqual($this->attributes['strength']['upper'] * 2, $randomAttack->getStrength());
        $this->assertGreaterThanOrEqual($this->attributes['strength']['lower'] * 2, $randomAttack->getStrength());
    }

    /**
     * We need to override this for Swordsman to pass the $zeroRandomiser
     * to make sure attack is never doubled (that comes in the next test)
     * 
     * @test
     * @covers Combatant::getStrength
     */
    public function strengthIsBetweenParameters() {
        $zeroRandomiser = new Randomiser(0);

        $weakAttack   = $this->weakCombatant->getStrength($zeroRandomiser);
        $strongAttack = $this->strongCombatant->getStrength($zeroRandomiser);
        $randomAttack = $this->randomCombatant->getStrength($zeroRandomiser);

        $this->assertEquals($this->attributes['strength']['lower'], $weakAttack);
        $this->assertEquals($this->attributes['strength']['upper'], $strongAttack);
        $this->assertLessThanOrEqual($this->attributes['strength']['upper'], $randomAttack);
        $this->assertGreaterThanOrEqual($this->attributes['strength']['lower'], $randomAttack);
    }

    /**
     * We need to override this for Swordsman to pass the $zeroRandomiser
     * to make sure attack is never doubled (that comes in the next test)
     *
     * @test
     * @covers Combatant::createAttack
     */
    public function canAttack() {
        $zeroRandomiser = new Randomiser(0);

        $attack = $this->weakCombatant->createAttack();
        $expectedAttack = new Attack($this->weakCombatant->getStrength($zeroRandomiser));
        
        $this->assertInstanceOf('Attack', $attack);
        
        $this->assertEquals($expectedAttack, $attack);
    }
}

