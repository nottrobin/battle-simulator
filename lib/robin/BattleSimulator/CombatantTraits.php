<?php //namespace BattleSimulator; @todo: work out how to get namespaces working with phpunit

require_once('lib/robin/Random/Randomiser.php');
include_once('lib/robin/BattleSimulator/Attack.php');

// Traits
trait AttackDoubles {
    /**
     * @param Randomiser $randomiser Allows randomiser to be set just for this method - for testing
     * @return Attack
     */
    public function createAttack(Randomiser $randomiser = null) {
        $randomiser = isset($randomiser) ? $randomiser : $this->getRandomiser();
        $attack = new Attack($this->getStrength());

        // 5% chance of doubling attack strength
        if($randomiser->generateBoolean(0.02)) {
            $attack->setMultiplier(2);
        } 

        return $attack;
    }
}

trait Stuns {
    /**
     * @param Randomiser $randomiser Allows randomiser to be set just for this method - for testing
     * @return Attack
     */
    public function createAttack(Randomiser $randomiser = null) {
        $randomiser = isset($randomiser) ? $randomiser : $this->getRandomiser();
        $attack = new Attack($this->getStrength());

        // 2% chance of stunning
        $attack->setStunning($randomiser->generateBoolean(0.02));
        
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

