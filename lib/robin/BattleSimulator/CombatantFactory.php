<?php //namespace BattleSimulator; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/Random/Randomiser.php');
require_once('lib/robin/BattleSimulator/Swordsman.php');
require_once('lib/robin/BattleSimulator/Brute.php');
require_once('lib/robin/BattleSimulator/Grappler.php');

class CombatantFactory {
    private $randomiser = null;
    private $classes = ['Swordsman', 'Brute', 'Grappler'];
    
    public function __construct(Randomiser $randomiser = null) {
        $this->setRandomiser($randomiser);
    }
    
    public function createSwordsman(Randomiser $randomiser = null) {
        return new Swordsman($randomiser);
    }
    
    public function createBrute(Randomiser $randomiser = null) {
        return new Brute($randomiser);
    }
    
    public function createGrappler(Randomiser $randomiser = null) {
        return new Grappler($randomiser);
    }
    
    public function createRandom() {
        $int = floor($this->getRandomiser()->generate() * count($this->classes));
        if($int == count($this->classes)) {$int--;}
        $className = $this->classes[$int];
        return $this->{'create'.$className}();
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

