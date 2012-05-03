<?php

require_once('lib/robin/BattleSimulator/Combatant.php');
require_once('lib/robin/BattleSimulator/Simulation.php');
require_once('lib/robin/BattleSimulator/Turn.php');

/**
 * A class for describing actions in a (battle) Simulation
 */
class Describer {
    private $smarty;
    private $textGenerator;

    const TEMPLATE_DIR              = 'templates';
    const BATTLE_DRAWN_TPL          = 'battleDrawn.tpl';
    const BATTLE_WON_TPL            = 'battleWon.tpl';
    const COMBATANT_DESCRIPTION_TPL = 'combatantDescription.tpl';
    const MISSED_TURN_TPL           = 'missedTurn.tpl';
    const SUCCESSFUL_ATTACK_TPL     = 'successfulAttack.tpl';
    const DODGED_ATTACK_TPL         = 'dodgedAttack.tpl';
    const SPECIAL_SKILL_TPL         = 'specialSkill.tpl';

    // Constructor
    // ==
    public function __construct(TextGenerator $generator = null, Smarty $smarty = null) {
        $this->setSmarty($smarty);
        $this->setTextGenerator($generator);
    }

    // Public methods
    // ==

    public function describeBattleWon(Simulation $simulation) {
        $this->displayTemplate(
            [
                'winner' => $simulation->getWinner()->getName(),
                'health' => $simulation->getWinner()->getHealth(),
                'loser'  => $simulation->getLoser()->getName(),
            ],
            self::BATTLE_WON_TPL
        );
    }

    public function describeBattleDrawn(Simulation $simulation) {
        $this->displayTemplate(
            [
                'combatantOne' => $simulation->getCombatant(0)->getName(),
                'healthOne'    => $simulation->getCombatant(0)->getHealth(),
                'combatantTwo' => $simulation->getCombatant(1)->getName(),
                'healthTwo'    => $simulation->getCombatant(1)->getHealth(),
            ],
            self::BATTLE_DRAWN_TPL
        );
    }

    public function describeCombatant(Combatant $combatant) {
        $this->displayTemplate(
            [
                'name'     => $combatant->getName(),
                'class'    => get_class($combatant),
                'health'   => $combatant->getHealth(),
                'strength' => $combatant->getStrength(),
                'defence'  => $combatant->getDefence(),
                'speed'    => $combatant->getSpeed(),
                'luck'     => round($combatant->getLuck(), 2)
            ],
            self::COMBATANT_DESCRIPTION_TPL
        );
    }

    public function describeTurn(Turn $turn) {
        if($turn->missed()) {
            $this->describeMissedTurn($turn);
        } else {
            if($turn->getAttack()->hasMissed()) {
                $this->describeDodgedAttack($turn);
            } else {
                $this->describeSuccessfulAttack($turn);
            }

            echo "\n";

            $this->describeSpecialSkill($turn);
        }
    }

    public function describeCombatants(Simulation $simulation) {
        $this->describeCombatant($simulation->getCombatant(0));
        echo "\n";
        $this->describeCombatant($simulation->getCombatant(1));
    }

    // Private methods
    // ==

    private function describeMissedTurn(Turn $turn) {
        $this->displayTemplate(
            ['attacker' => $turn->getAttacker()->getName()],
            self::MISSED_TURN_TPL
        );
    }

    private function describeDodgedAttack(Turn $turn) {
        $this->displayTemplate(
            [
                'attacker'        => $turn->getAttacker()->getName(),
                'defender'        => $turn->getDefender()->getName(),
                'verb'            => $this->getTextGenerator()->getVerb(),
                'weaponAdjective' => $this->getTextGenerator()->getWeaponAdjective(),
                'noun'            => $this->getTextGenerator()->getNoun(),
                'appendix'        => $this->getTextGenerator()->getAppendix(),
                'dodgeAdjective'  => $this->getTextGenerator()->getDodgeAdjective(),
                'abstractNoun'    => $this->getTextGenerator()->getAbstractNoun()
            ],
            self::DODGED_ATTACK_TPL
        );
    }

    private function describeSuccessfulAttack(Turn $turn) {
        $this->displayTemplate(
            [
                'attacker'        => $turn->getAttacker()->getName(),
                'attackStrength'  => $turn->getAttack()->getStrength(),
                'defender'        => $turn->getDefender()->getName(),
                'defence'         => $turn->getDefender()->getDefence(),
                'damage'          => $turn->getAttack()->getDamage(),
                'health'          => $turn->getDefender()->getHealth(),
                'verb'            => $this->getTextGenerator()->getVerb(),
                'weaponAdjective' => $this->getTextGenerator()->getWeaponAdjective(),
                'noun'            => $this->getTextGenerator()->getNoun(),
                'appendix'        => $this->getTextGenerator()->getAppendix(),
                'dodgeAdjective'  => $this->getTextGenerator()->getDodgeAdjective(),
                'abstractNoun'    => $this->getTextGenerator()->getAbstractNoun()
            ],
            self::SUCCESSFUL_ATTACK_TPL
        );
    }

    private function describeSpecialSkill(Turn $turn) {
        $retaliation = $turn->getAttack()->getRetaliation();
        $this->displayTemplate(
            [
                'attacker' => $turn->getAttacker()->getName(),
                'defender' => $turn->getDefender()->getName(),
                'health'   => $turn->getAttacker()->getHealth(),
                'damage'   => isset($retaliation) ? $retaliation->getStrength() : false,
                'luckyStrike'   => $turn->getAttack()->isLucky(),
                'stunningBlow'  => $turn->getAttack()->isStunning(),
                'counterAttack' => isset($retaliation)
            ],
            self::SPECIAL_SKILL_TPL
        );
    }

    private function displayTemplate(Array $vars, $templatePath) {
        $this->getSmarty()->clearAllAssign();
        $this->getSmarty()->assign($vars);
        $this->getSmarty()->display(self::TEMPLATE_DIR . '/' . $templatePath);
    }

    // Inline factory methods
    // ==

    public function setTextGenerator(TextGenerator $generator = null) {
        $this->textGenerator = $generator;
    }

    public function getTextGenerator() {
        if(!$this->textGenerator instanceof TextGenerator) {
            $this->textGenerator = new TextGenerator();
        }

        return $this->textGenerator;
    }

    public function setSmarty(Smarty $smarty = null) {
        $this->smarty = $smarty;
    }

    private function getSmarty() {
        if(!$this->smarty instanceof Smarty) {
            $this->smarty = new Smarty();
        }

        return $this->smarty;
    }
}

