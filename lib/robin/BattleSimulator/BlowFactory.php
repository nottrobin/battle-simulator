<?php //namespace BattleSimulator; // @todo work out how to get namespaces working with phpunit

require_once('lib/robin/BattleSimulator/Attack.php');
require_once('lib/robin/BattleSimulator/Retaliation.php');

/**
 * A factory class for Blows
 */
class BlowFactory {
    /**
     * @return Attack (specialisation of Blow)
     */
    public function createAttack($strength, $stunning = null) {
        return new Attack($strength, $stunning);
    }

    /**
     * @return Retaliation (specialisation of Blow)
     */
    public function createRetaliation($strength) {
        return new Retaliation($strength);
    }
}
