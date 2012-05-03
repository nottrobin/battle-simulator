<?php //namespace BattleSimulator; @todo work out how to get phpunit to work with namespaces

require_once('lib/robin/BattleSimulator/Combatant.php');
require_once('lib/robin/BattleSimulator/Turn.php');

/**
 * This is the main point of entry for a battle simulation
 * It takes two combatants, and makes them fight.
 * Simulation is advanced using Simulation::performTurn
 */

class Simulation {
    private $combatants;
    private $combatantFactory;
    private $whoseTurn;
    private $turnsPassed = 0;

    public function __construct(
        $firstCombatantName = null,
        $secondCombatantName = null,
        CombatantFactory $factory = null
    ) {
        $this->setCombatantFactory($factory);
        $this->combatants = [
            $this->getCombatantFactory()->createRandom($firstCombatantName),
            $this->getCombatantFactory()->createRandom($secondCombatantName)
        ];
        $this->whoseTurn  = $this->whoGoesFirst();
    }

    public function performTurn() {
        $turn = null;

        if(!$this->isOver()) {
            $turn = new Turn($this->getAttacker(), $this->getDefender());
            $this->switchTurn();
            $this->turnsPassed++;
        }

        return $turn;
    }

    public function isOver() {
        return $this->isWon() || $this->turnsPassed >= 30;
    }

    public function isWon() {
        return $this->combatants[0]->getHealth() <= 0 || $this->combatants[1]->getHealth() <= 0;
    }

    public function getWinner() {
        $winner = null;

        if($this->getLoser() == $this->combatants[0]) {
            $winner = $this->combatants[1];
        } else if($this->getLoser() == $this->combatants[1]) {
            $winner = $this->combatants[0];
        }

        return $winner;
    }

    public function getLoser() {
        $loser = null;

        if($this->combatants[0]->getHealth() <= 0) {
            $loser = $this->combatants[0];
        } else if($this->combatants[1]->getHealth() <= 0) {
            $loser = $this->combatants[1];
        }

        return $loser;
    }

    public function getCombatant($key) {
        return $this->combatants[$key];
    }

    public function getTurnNumber() {
        return $this->turnsPassed;
    }

    private function switchTurn() {
        $this->whoseTurn = 1 - $this->whoseTurn;
    }

    private function whoGoesFirst() {
        $first = 0; // If all else fails, combatant one will go first
        $one   = $this->combatants[0];
        $two   = $this->combatants[1];

        if($one->getSpeed() > $two->getSpeed()) {
            // If 1 is faster, they go first
            $first = 0;
        } else if($two->getSpeed() > $one->getSpeed()) {
            // If 2 is faster they go first
            $first = 1;
        } else if($one->getDefence() < $two->getDefence()) {
            // If 1 has lower defence they go first
            $first = 0;
        } else if($two->getDefence() < $one->getDefence()) {
            // If 2 has lower defence they go first
            $first = 1;
        }

        return $first;
    }

    private function getAttacker() {
        return $this->combatants[$this->whoseTurn];
    }

    private function getDefender() {
        return $this->combatants[1-$this->whoseTurn];
    }

    // Inline factory functions
    // ==

    public function setCombatantFactory(CombatantFactory $factory = null) {
        $this->combatantFactory = $factory;
    }

    private function getCombatantFactory() {
        if(!$this->combatantFactory instanceof CombatantFactory) {
            $this->combatantFactory = new CombatantFactory();
        }

        return $this->combatantFactory;
    }
}

