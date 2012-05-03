#!/usr/bin/env php

<?php

require_once('lib/robin/BattleSimulator/Simulation.php');
require_once('lib/robin/BattleSimulator/CombatantFactory.php');
require_once('lib/Smarty/Smarty.class.php');

$factory = new CombatantFactory();

$firstName  = readline("What name will you deign to give the first combatant?\n");
$secondName = readline("What name shall the second combatant have?\n");

$smarty = new Smarty();

die(var_dump($firstName, $secondName));

exit;
// Get the names for my combatants
// echo "Give me the name for the first combatant:\n";
// $nameOne = trim(fgets(STDIN));
// $combatantOne = $factory->createRandom();
// if(!$combatantOne->setName($nameOne)) {
//     echo "\nCould not set the name for the contestant\n";
//     exit;
// }
// echo "\n"
//      . $combatantOne->getName()
//      . ' is a '
//      . get_class($combatantOne)
//      . ' with '
//      . $combatantOne->getHealth() . ' health'
//      . ', ' . $combatantOne->getStrength() . ' strength'
//      . ', ' . $combatantOne->getDefence() . ' defence'
//      . ', ' . $combatantOne->getSpeed() . ' speed'
//      . ' and ' . $combatantOne->getLuck() . ' luck.'
//      . "\n";
// 
// // Get the names for my combatants
// echo "Give me the name for the second combatant:\n";
// $nameTwo = trim(fgets(STDIN));
// $combatantTwo = $factory->createRandom();
// if(!$combatantTwo->setName($nameTwo)) {
//     echo "\nCould not set the name for the contestant\n";
//     exit;
// }
// echo "\n"
//      . $combatantTwo->getName()
//      . ' is a '
//      . get_class($combatantTwo)
//      . ' with '
//      . $combatantTwo->getHealth() . ' health'
//      . ', ' . $combatantTwo->getStrength() . ' strength'
//      . ', ' . $combatantTwo->getDefence() . ' defence'
//      . ', ' . $combatantTwo->getSpeed() . ' speed'
//      . ' and ' . $combatantTwo->getLuck() . ' luck.'
//      . "\n";
// 
// $simulation = new BattleSimulation($combatantOne, $combatantTwo);
// 
// while($turn = $simulation->performTurn()) {
//     $att = $turn->getAttacker();
//     $def = $turn->getDefender();
//     $attack = $turn->getAttack();
// 
//     if($turn->missed()) {
//         echo $att->getName() . ' missed their turn' . "\n";
//         continue;
//     }
// 
//     echo $att->getName() . ' attacked ' . $def->getName() . "\n";
// }
// 
