<?php

require_once('lib/BattleSimulation.php');

class BattleSimulationTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $combatantFactory = new CombatantFactory();
        $this->combatantOne     = $combatantFactory->createSwordsman();
        $this->combatantTwo     = $combatantFactory->createBrute();
        $this->simulation = new BattleSimulation($this->combatantOne, $this->combatantTwo);
    }
    
    /**
     * @test
     * @covers BattleSimulation::performTurn
     */
    public function canGetNextTurn() {
        $turn = $this->simulation->performTurn();
        $this->assertInstanceOf('BattleTurn', $turn);
    }
    
    /**
     * @test
     * @covers BattleSimulation::isBattleOver
     */
    public function canCheckIfBattleIsFinished() {
        $this->assertFalse($this->simulation->isOver());
        // Kill combatant one
        $this->combatantOne->receiveRetaliation(new Retaliation($this->combatantOne->getHealth()));
        // Now see if the battle is over
        $this->assertTrue($this->simulation->isOver());
    }
}

