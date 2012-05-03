<?php //namespace BattleSimulator; @todo: Get phpunit working with namespaces

require_once('lib/robin/BattleSimulator/Combatant.php');

class Turn {
    private $attacker;
    private $defender;

    public function __construct(Combatant $attacker, Combatant $defender) {
        $this->attacker = $attacker;
        $this->defender = $defender;
    }

    public function getAttacker() {
        return $this->attacker;
    }

    public function getDefender() {
        return $this->defender;
    }

    public function getAttack() {
        $attack = null;

        if(!$this->missed()) {
            $attack = $this->getAttacker()->createAttack();
        }

        return $attack;
    }

    public function missed() {
        return $this->getAttacker()->isStunned();
    }
}

