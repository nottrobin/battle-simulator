<?php //namespace BattleSimulator; // @todo work out how to get namespaces working with phpunit

/**
 * Base class for Attack and Retaliation blows
 * that are used for fights between Combatants in a (battle) Simulation
 *
 * @author robin@robinwinslow.co.uk
 */
abstract class Blow {
    protected $strength    = null;
    
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
}

