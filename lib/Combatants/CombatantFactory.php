<?php

require_once('lib/Randomisation/Randomiser.php');
require_once('lib/Combatants/Swordsman.php');
require_once('lib/Combatants/Brute.php');
require_once('lib/Combatants/Grappler.php');

class CombatantFactory {
    private $randomiser = null;
    private $classes = ['Swordsman', 'Brute', 'Grappler'];
    
    public function __construct(Randomiser $randomiser = null) {
        $this->setRandomiser($randomiser);
    }
    
    public function createSwordsman(Randomiser $randomiser = null, BooleanGenerator $booleanGenerator = null) {
        return new Swordsman($randomiser, $booleanGenerator);
    }
    
    public function createBrute(Randomiser $randomiser = null, BooleanGenerator $booleanGenerator = null) {
        return new Brute($randomiser, $booleanGenerator);
    }
    
    public function createGrappler(Randomiser $randomiser = null, BooleanGenerator $booleanGenerator = null) {
        return new Grappler($randomiser, $booleanGenerator);
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

