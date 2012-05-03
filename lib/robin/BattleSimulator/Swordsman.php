<?php //namespace BattleSimulator; @todo: work out how to get namespaces working with phpunit

require_once('lib/robin/BattleSimulator/Combatant.php');
include_once('lib/robin/BattleSimulator/CombatantTraits.php');

class Swordsman extends Combatant {
    use AttackDoubles;

    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(40, 60);
    }
    
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(60, 70);
    }
    
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(20, 30);
    }
    
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(90, 100);
    }
    
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.5);
    }
}

