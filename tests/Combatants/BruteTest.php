<?php

require_once('tests/Combatants/CombatantTest.php');
require_once('lib/Combatants/Brute.php');
require_once('lib/Randomisation/BooleanGenerator.php');

class BruteTest extends CombatantTest {
    protected $attributes = array(
        'health'   => ['lower' => 90,  'upper' => 100],
        'strength' => ['lower' => 65,  'upper' => 75],
        'defence'  => ['lower' => 40,  'upper' => 50],
        'speed'    => ['lower' => 40,  'upper' => 65],
        'luck'     => ['lower' => 0.3, 'upper' => 0.35]
    );


    protected function createCombatant($randomiser = null) {
        return new Brute($randomiser);
    }
}

