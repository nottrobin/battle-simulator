<?php //namespace BattleSimulator; @todo: work out how to get namespaces working with phpunit

require_once('lib/robin/Random/Randomiser.php');
include_once('lib/robin/BattleSimulator/Attack.php');

/**
 * Traits for Combatants to "use"
 * These are special skills that give combatants a chance of having an advantage
 */
trait LuckyStrike {
    /**
     * @param Randomiser $randomiser Allows randomiser to be set just for this method - for testing
     * @return Attack
     */
    public function createAttack(Randomiser $randomiser = null) {
        $randomiser = isset($randomiser) ? $randomiser : $this->getRandomiser();
        $attack = new Attack($this->getStrength());

        // 5% chance of doubling attack strength
        if(!$attack->hasMissed()) {
            $attack->setLucky($randomiser->generateBoolean(0.02));
        }

        return $attack;
    }
}

trait StunningBlow {
    /**
     * @param Randomiser $randomiser Allows randomiser to be set just for this method - for testing
     * @return Attack
     */
    public function createAttack(Randomiser $randomiser = null) {
        $randomiser = isset($randomiser) ? $randomiser : $this->getRandomiser();
        $attack = new Attack($this->getStrength());

        // 2% chance of stunning
        if(!$attack->hasMissed()) {
            $attack->setStunning($randomiser->generateBoolean(0.02));
        }
        
        return $attack;
    }
}

trait CounterAttack {
    public function receiveAttack(Attack $attack) {
        if($this->dodgedAttack()) {
            $attack->missed();
            $attack->setRetaliation($this->getBlowFactory()->createRetaliation(10));
        } else {
            $attack->applyDefence($this->getDefence());
            $attack = $this->receiveBlow($attack);
            $this->setStunned($attack->isStunning());
        }


        return $attack;
    }
}

