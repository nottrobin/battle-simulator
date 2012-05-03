<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/BattleSimulator/Simulation.php');
require_once('lib/robin/BattleSimulator/Turn.php');
require_once('lib/robin/BattleSimulator/CombatantFactory.php');
require_once('lib/robin/BattleSimulator/Retaliation.php');

class SimulationTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $combatantFactory = new CombatantFactory();
        $this->combatantOne     = $combatantFactory->createSwordsman();
        $this->combatantTwo     = $combatantFactory->createBrute();
        $this->simulation = new Simulation($this->combatantOne, $this->combatantTwo);
    }
    
    /**
     * @test
     * @covers BattleSimulation::performTurn
     */
    public function canGetNextTurn() {
        $turn = $this->simulation->performTurn();
        $this->assertInstanceOf('Turn', $turn);
    }
    
    /**
     * @test
     * @covers BattleSimulation::isBattleOver
     */
    public function canCheckIfBattleIsFinished() {
        $this->assertFalse($this->simulation->isOver());
        // Kill combatant one
        $this->combatantOne->receiveBlow(new Retaliation($this->combatantOne->getHealth()));
        // Now see if the battle is over
        $this->assertTrue($this->simulation->isOver());
    }
}

