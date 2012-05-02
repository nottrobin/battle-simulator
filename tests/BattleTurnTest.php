<?php

class BattleTurnTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $combatantFactory = new CombatantFactory();
        $attacker         = $combatantFactory->createSwordsman();
        $defender         = $combatantFactory->createBrute();
        $this->turn       = new BattleTurn($attacker, $defender);
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

