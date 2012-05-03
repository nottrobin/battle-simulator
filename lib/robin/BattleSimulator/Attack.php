<?php //namespace BattleSimulator; // @todo work out how to get namespaces working with phpunit

require_once('lib/robin/BattleSimulator/Blow.php');
require_once('lib/robin/BattleSimulator/Retaliation.php');

/**
 * This is a transaction class to be passed between Combatants in a BattleSimulation
 * It holds data about an attack made by one contestant on another
 *
 * @author robin@robinwinslow.co.uk
 */
class Attack extends Blow {
    private $retaliation = null;
    private $stunning    = false;
    private $missed      = false;
    private $multiplier  = 1;
    
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

    public function getStrength() {
        return $this->strength * $this->multiplier;
    }

    public function setMultiplier($multiplier) {
        $this->multiplier = $multiplier;
    }

    public function getBaseStrength() {
        return $this->strength;
    }

    public function setStunning($isStunning) {
        $this->stunning = $isStunning;
        return true;
    }

    public function isStunning() {
        return $this->stunning;
    }
    
    public function missed() {
        $this->setDamage(0);
        $this->missed = true;
        
        return true;
    }
    
    public function hasMissed() {
        return $this->missed;
    }
    
    public function setRetaliation(Retaliation $retaliation) {
        $this->retaliation = $retaliation;
        
        return true;
    }
    
    public function getRetaliation() {
        return $this->retaliation;
    }

    public function applyDefence($defenceStrength ) {
        $this->strength = $this->getStrength() - $defenceStrength;
        if($this->getStrength() < 0) {
            $this->strength = 0;
        }
        return true;
    }
}

