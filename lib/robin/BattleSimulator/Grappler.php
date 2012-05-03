<?php //namespace BattleSimulator; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/BattleSimulator/Combatant.php');
require_once('lib/robin/BattleSimulator/CombatantTraits.php');

/**
 * A class of Combatant for use in (battle) Simulations
 */
class Grappler extends Combatant {
    use CounterAttack;

    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(60, 100);
    }
    
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(75, 80);
    }
    
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(35, 40);
    }
    
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(60, 80);
    }
    
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.4);
    }
}

