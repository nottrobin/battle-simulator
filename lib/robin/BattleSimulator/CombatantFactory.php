<?php //namespace BattleSimulator; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/Random/Randomiser.php');
require_once('lib/robin/BattleSimulator/Swordsman.php');
require_once('lib/robin/BattleSimulator/Brute.php');
require_once('lib/robin/BattleSimulator/Grappler.php');

/**
 * This generates Combatants for use in (battle) Simulations.
 * It is particularly useful for the CombatantFactory::createRandom method
 * that will give you a random Combatant class
 */
class CombatantFactory {
    private $randomiser = null;
    private $classes = ['Swordsman', 'Brute', 'Grappler'];
    
    public function __construct(Randomiser $randomiser = null) {
        $this->setRandomiser($randomiser);
    }
    
    public function createSwordsman($name, Randomiser $randomiser = null) {
        return new Swordsman($name, $randomiser);
    }
    
    public function createBrute($name, Randomiser $randomiser = null) {
        return new Brute($name, $randomiser);
    }
    
    public function createGrappler($name, Randomiser $randomiser = null) {
        return new Grappler($name, $randomiser);
    }
    
    public function createRandom($name) {
        $className = $this->getRandomiser()->getArrayItem($this->classes);
        return $this->{'create'.$className}($name);
    }
    
    public function setRandomiser(Randomiser $randomiser = null) {
        $this->randomiser = $randomiser;
    }
    
    private function getRandomiser() {
        if(!$this->randomiser instanceof Randomiser) {
            $this->randomiser = new Randomiser();
        }
        
        return $this->randomiser;
    }
}

