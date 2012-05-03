<?php //namespace BattleSimulator; // @todo work out how to get namespaces working with phpunit

/**
 * This is a transaction class to be passed between Combatants in a BattleSimulation
 * It holds data about an attack made by one contestant on another
 *
 * @author robin@robinwinslow.co.uk
 */
abstract class Blow {
    protected $strength    = null;
    protected $damage      = null;
    protected $killing   = false;
    
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
    }
    
    public function getStrength() {
        return $this->strength;
    }
    
    public function setDamage($damage) {
        $this->damage = $damage;
        
        return true;
    }
    
    public function getDamage() {
        return $this->damage;
    }
    
    public function setKilling($isKilling) {
        $this->killing = $isKilling;
        return true;
    }
    
    public function isKilling() {
        return $this->killing;
    }
}

