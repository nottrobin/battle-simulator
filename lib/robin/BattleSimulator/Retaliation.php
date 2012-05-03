<?php //namespace BattleSimulator; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/BattleSimulator/Blow.php');

/**
 * A type of Blow, this can be attached to an Attack to deal retaliation damage to a Combatant
 */
class Retaliation extends Blow {
    public function getDamage() {
        return $this->getStrength();
    }
}


