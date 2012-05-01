<?php

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
}

