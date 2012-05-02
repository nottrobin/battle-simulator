<?php

require_once('lib/Blow/Attack.php');
require_once('lib/Blow/Retaliation.php');

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
