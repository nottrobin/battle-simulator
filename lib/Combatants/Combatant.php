<?php

abstract class Combatant {
    protected $health           = null;
    protected $strength         = null;
    protected $defence          = null;
    protected $speed            = null;
    protected $luck             = null;
    private   $name             = null;
    protected $randomiser       = null;
    protected $blowFactory      = null;
    
    public function __construct(Randomiser $randomiser = null) {
        $this->setRandomiser($randomiser);
        $this->generateHealth();
        $this->generateStrength();
        $this->generateDefence();
        $this->generateSpeed();
        $this->generateLuck();
    }
    
    public function getHealth() {
        return $this->health;
    }
    
    public function getAttackStrength() {
        return $this->strength;
    }
    
    public function getDefence() {
        return $this->defence;
    }
    
    public function getSpeed() {
        return $this->speed;
    }
    
    public function getLuck() {
        return $this->luck;
    }
    
    public function setName($name) {
        $success = false;
        
        if(strlen($name) > 30) {
            trigger_error('Name not set: Must be 30 characters or less', E_USER_WARNING);
        } else {
            $this->name = $name;
            $success = true;
        }
        
        return $success;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function createAttack() {
        return $this->getBlowFactory()->createAttack($this->getAttackStrength());
    }
    
    public function receiveAttack(Attack $attack) {
        $potentialDamage = $attack->getStrength() - $this->getDefence();

        if($this->dodgedAttack()) {
            $attack->missed();
        } else {
            $damageDealt = $this->dealDamage($potentialDamage);
            $attack->setDamage($damageDealt);
            $attack->setKilling($this->isDead());
        }

        return $attack;
    }

    public function receiveRetaliation(Retaliation $retaliation) {
        $startHealth = $this->getHealth();
        $retaliation->setDamage($this->dealDamage($retaliation->getStrength()));
        $retaliation->setKilling($this->isDead());

        return $retaliation;
    }
    
    protected function dealDamage($damage) {
        $startingHealth = $this->getHealth();

        $this->health -= $damage;

        if($this->getHealth() < 0) {
            $this->health = 0;
        }
        
        return $startingHealth - $this->getHealth();
    }

    protected function dodgedAttack() {
        return 1 - $this->randomiser->generate() < $this->getLuck();
    }
    
    protected function randomNumberBetween($lower, $upper) {
        $difference = $upper - $lower;
        return $lower + $this->getRandomiser()->generate() * $difference;
    }
    
    // Dependency injector method for randomiser
    public function setRandomiser(Randomiser $randomiser = null) {
        $this->randomiser = $randomiser;
    }
    
    protected function getRandomiser() {
        if (!$this->randomiser instanceof Randomiser) {
            $this->randomiser = new Randomiser();
        }
        
        return $this->randomiser;
    }

    public function setBlowFactory(BlowFactory $blowFactory) {
        $this->blowFactory = $blowFactory;
    }

    protected function getBlowFactory() {
        if(!$this->blowFactory instanceof BlowFactory) {
            $this->blowFactory = new BlowFactory();
        }
        return $this->blowFactory;
    }

    protected function isDead() {
        return $this->getHealth() <= 0;
    }
    
    abstract protected function generateHealth();
    
    abstract protected function generateStrength();
    
    abstract protected function generateDefence();
    
    abstract protected function generateSpeed();
    
    abstract protected function generateLuck();
}

// Traits
trait AttackBonus {
    public function getAttackStrength(BooleanGenerator $boolGenerator = null) {
        // Default boolean generator to 5%
        $boolGenerator = isset($boolGenerator) ? $boolGenerator : new BooleanGenerator(0.05);

        $attackStrength = $this->strength;
        
        if($boolGenerator->generate()) {
            $attackStrength = $attackStrength * 2;
        }
        
        return $attackStrength;
    }
}

trait Stuns {
    public function createAttack(BooleanGenerator $boolGenerator = null) {
        // Default boolean generator to 2%
        $boolGenerator = isset($boolGenerator) ? $boolGenerator : new BooleanGenerator(0.02);
        $attack = new Attack($this->getAttackStrength());
        $attack->setStunning($boolGenerator->generate());
        return $attack;
    }
}

trait HasRetaliation {
    public function receiveAttack(Attack $attack) {
        $potentialDamage = $attack->getStrength() - $this->getDefence();

        if($this->dodgedAttack()) {
            $attack->missed();
            $attack->setRetaliation($this->getBlowFactory()->createRetaliation(10));
        } else {
            $damageDealt = $this->dealDamage($potentialDamage);
            $attack->setDamage($damageDealt);
            $attack->setKilling($this->isDead());
        }

        return $attack;
    }
}

