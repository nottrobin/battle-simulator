<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/BattleSimulator/CombatantFactory.php');
require_once('lib/robin/BattleSimulator/Turn.php');

class TurnTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $combatantFactory = new CombatantFactory();
        $attacker         = $combatantFactory->createSwordsman('phil');
        $defender         = $combatantFactory->createBrute('steve');
        $this->turn       = new Turn($attacker, $defender);
    }
    
    /**
     * @test
     * @covers BattleTest::getAttacker
     * @covers BattleTest::getDefender
     */
    public function canGetAttackerAndDefender() {
        $this->assertInstanceOf('Swordsman', $this->turn->getAttacker());
        $this->assertInstanceOf('Brute', $this->turn->getDefender());
    }
    
    /**
     * @test
     * @covers BattleTest::getAttacker
     */
    public function canGetAttack() {
        $this->assertInstanceOf('Attack', $this->turn->getAttack());
    }
}

