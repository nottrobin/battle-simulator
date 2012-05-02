<?php

require_once('lib/BattleTurn.php');

class BattleSimulation {
    private $combatants;
    private $whoseTurn;
    private $turnsPassed = 0;

    public function __construct(Combatant $firstCombatant, Combatant $secondCombatant) {
        $this->combatants = [$firstCombatant, $secondCombatant];
        $this->whoseTurn  = $this->whoGoesFirst();
    }

    public function performTurn() {
        $turn = null;

        if(!$this->isOver()) {
            $turn = new BattleTurn($this->getAttacker(), $this->getDefender());
            $this->switchTurn();
            $this->turnsPassed++;
        }

        return $turn;
    }

    public function getWinner() {
        $winner = null;

        if($this->isOver()) {
            $one   = $this->combatants[0];
            $two   = $this->combatants[1];
            if($two->getHealth() <= 0 && $one->getHealth() > 0) {
                $winner = $one;
            } else if($one->getHealth() <= 0 && $two->getHealth() > 0) {
                $winner = $two;
            }
        }

        return $winner;
    }

    public function isOver() {
        $one   = $this->combatants[0];
        $two   = $this->combatants[1];
        return $one->getHealth() <= 0
               || $two->getHealth() <= 0
               || $this->turnsPassed >= 30;
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
}

