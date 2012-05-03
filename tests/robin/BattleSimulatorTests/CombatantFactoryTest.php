<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/Random/Randomiser.php');
require_once('lib/robin/BattleSimulator/CombatantFactory.php');

class CombatantFactoryTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $zeroRandomiser = new Randomiser(0);
        $halfRandomiser = new Randomiser(0.5);
        $oneRandomiser  = new Randomiser(1);
        $this->randomSwordsmanFactory = new CombatantFactory($zeroRandomiser);
        $this->randomBruteFactory     = new CombatantFactory($halfRandomiser);
        $this->randomGrapplerFactory  = new CombatantFactory($oneRandomiser);
    }

    /**
     * @test
     * @covers CombatantFactory::createSwordsman
     * @covers CombatantFactory::createBrute
     * @covers CombatantFactory::createGrappler
     */
    public function canCreateAllTypes() {
        // Creating directly, doesn't matter which factory we use
        $this->assertInstanceOf('Swordsman', $this->randomSwordsmanFactory->createSwordsman('phil'));
        $this->assertInstanceOf('Brute',     $this->randomSwordsmanFactory->createBrute('steve'));
        $this->assertInstanceOf('Grappler',  $this->randomSwordsmanFactory->createGrappler('chips'));
    }

    /**
     * @test
     * @covers CombatantFactory::createRandom
     */
    public function canCreateAllTypesRandomly() {
        // Use rigged factories to check we get expected "random" results
        $this->assertInstanceOf('Swordsman', $this->randomSwordsmanFactory->createRandom('phil'));
        $this->assertInstanceOf('Brute',     $this->randomBruteFactory->createRandom('steve'));
        $this->assertInstanceOf('Grappler',  $this->randomGrapplerFactory->createRandom('chips'));
    }
}

