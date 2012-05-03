<?php //namespace BattleSimulator; // @todo work out how to get namespaces working with phpunit

require_once('lib/robin/BattleSimulator/Blow.php');
require_once('lib/robin/BattleSimulator/Retaliation.php');

/**
 * This is a transaction class to be passed between Combatants in a Simulation
 * It holds data about an attack made by one contestant on another
 *
 * @author robin@robinwinslow.co.uk
 */
class Attack extends Blow {
    private $retaliation = null;
    private $stunning    = false;
    private $missed      = false;
    private $isLucky     = false;
    private $multiplier  = 1;
    private $damage      = 0;
    
    /**
     * An attack must be passed an $attackStrength at construction
     * Optionally an attack can be a $stunning attack
     *
     * @param int $strength
     * @param bool $stunning Defaults to false
     * @return null
     */
    public function __construct($strength, $stunning = null) {
        $this->strength = $strength;
        $this->stunning = isset($stunning) ? $stunning : false;
    }

    // Public methods
    // ==

    public function getStrength() {
        return $this->strength * $this->multiplier;
    }

    public function getDamage() {
        return $this->damage;
    }

    public function getBaseStrength() {
        return $this->strength;
    }

    public function getRetaliation() {
        return $this->retaliation;
    }

    public function setStunning($isStunning) {
        $this->stunning = $isStunning;
        return true;
    }

    public function setLucky($isLucky) {
        $this->isLucky = $isLucky;

        if($this->isLucky()) {
            $this->multiplier = 2;
        }
    }

    public function setRetaliation(Retaliation $retaliation) {
        $this->retaliation = $retaliation;
        
        return true;
    }
    
    public function missed() {
        $this->missed = true;
        
        return true;
    }
    
    public function applyDefence($defenceStrength ) {
        $this->damage = $this->getStrength() - $defenceStrength;

        return true;
    }

    public function isLucky() {
        return $this->isLucky;
    }

    public function isStunning() {
        return $this->stunning;
    }
    
    public function hasMissed() {
        return $this->missed;
    }
}

