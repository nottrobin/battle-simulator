<?php //namespace BattleSimulator; @todo: Get phpunit working with namespaces

require_once('lib/robin/BattleSimulator/Combatant.php');

/**
 * This is used by Simulation to generate turns of Attacks between Combatants
 */
class Turn {
    private $attacker;
    private $defender;
    private $attack;
    private $attackerStunned = false;

    public function __construct(Combatant $attacker, Combatant $defender) {
        $this->attacker = $attacker;
        $this->defender = $defender;
        $this->attackerStunned = $this->getAttacker()->wasStunned();
        $this->attack = $this->performAttack();
    }

    public function getAttacker() {
        return $this->attacker;
    }

    public function getDefender() {
        return $this->defender;
    }

    private function performAttack() {
        $attack = null;

        if(!$this->missed()) {
            $attack = $this->getAttacker()->createAttack();
            $attack = $this->getDefender()->receiveAttack($attack);
            if($attack->getRetaliation() instanceof Retaliation) {
                $this->getAttacker()->receiveBlow($attack->getRetaliation());
            }
        }

        return $attack;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function missed() {
        return $this->attackerStunned;
    }
}

