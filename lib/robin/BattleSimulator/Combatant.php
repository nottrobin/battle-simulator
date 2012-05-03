<?php //namespace BattleSimulator; @todo: work out how to get namespaces working with phpunit

require_once('lib/robin/Random/Randomiser.php');
require_once('lib/robin/BattleSimulator/BlowFactory.php');

abstract class Combatant {
    protected $health           = null;
    protected $strength         = null;
    protected $defence          = null;
    protected $speed            = null;
    protected $luck             = null;
    protected $stunned          = false;
    private   $name             = null;
    protected $randomiser       = null;
    protected $blowFactory      = null;
    
    public function __construct($name, Randomiser $randomiser = null) {
        $this->setRandomiser($randomiser);
        $this->setName($name);
        $this->generateHealth();
        $this->generateStrength();
        $this->generateDefence();
        $this->generateSpeed();
        $this->generateLuck();
    }
    
    public function getHealth() {
        return $this->health;
    }
    
    public function getStrength() {
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
    
    private function setName($name) {
        $success = false;
        
        if(strlen($name) > 30) {
            throw new CombatantNameLengthException('Name not set: Must be 30 characters or less');
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
        return $this->getBlowFactory()->createAttack($this->getStrength());
    }
    
    public function receiveAttack(Attack $attack) {
        $attack->applyDefence($this->getDefence());

        if($this->dodgedAttack()) {
            $attack->missed();
        } else {
            $attack = $this->receiveBlow($attack);
            $this->setStunned($attack->isStunning());
        }

        return $attack;
    }

    public function receiveBlow(Blow $retaliation) {
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

    public function isStunned() {
        return $this->stunned;
    }

    protected function setStunned($stunned) {
        $this->stunned = $stunned;

        return true;
    }
    
    abstract protected function generateHealth();
    
    abstract protected function generateStrength();
    
    abstract protected function generateDefence();
    
    abstract protected function generateSpeed();
    
    abstract protected function generateLuck();
}

class CombatantNameLengthException extends LengthException {}

