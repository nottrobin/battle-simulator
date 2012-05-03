<?php //namespace BattleSimulator; @todo: work out how to get namespaces working with phpunit

require_once('lib/robin/BattleSimulator/Combatant.php');
require_once('lib/robin/BattleSimulator/CombatantTraits.php');

class Brute extends Combatant {
    use Stuns;

    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(90, 100);
    }
    
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(65, 75);
    }
    
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(40, 50);
    }
    
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(40, 65);
    }
    
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.35);
    }
}
