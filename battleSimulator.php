#!/usr/bin/env php

<?php

require_once('lib/robin/BattleSimulator/Simulation.php');
require_once('lib/robin/BattleSimulator/Describer.php');
require_once('lib/robin/BattleSimulator/CombatantFactory.php');
require_once('lib/robin/BattleSimulator/TextGenerator.php');
require_once('lib/Smarty/Smarty.class.php');

// Create necessary objects
$factory   = new CombatantFactory();
$describer = new Describer();

// Get combatant names
$firstName  = readline("What name will you deign to give the first combatant?\n");
$secondName = readline("What name shall the second combatant receive?\n");

// Create simulation
$simulation = new Simulation($firstName, $secondName);

// Describe combatants
$describer->describeCombatants($simulation);

// Start running turns
while($turn = $simulation->performTurn()) {
    echo "\n\nTurn " . $simulation->getTurnNumber() . ":\n\n";

    $describer->describeTurn($turn);

    if($simulation->isOver()) {
        echo "\n";

        if($simulation->isWon()) {
            $describer->describeBattleWon($simulation);
        } else {
            $describer->describeBattleDrawn($simulation);
        }
    }
}

exit;

