<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('tests/robin/BattleSimulatorTests/BlowTest.php');
require_once('lib/robin/BattleSimulator/BlowFactory.php');

class RetaliationTest extends BlowTest {
    protected function getBlow($strength) {
        return (new BlowFactory())->createRetaliation($strength);
    }
}

