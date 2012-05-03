<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/Random/Randomiser.php');
require_once('lib/robin/BattleSimulator/CombatantFactory.php');

class CombatantFactoryTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $randomZero = $this->getMock('Randomiser');
        $randomZero->expects($this->any())
                   ->method('generate')
                   ->will($this->returnValue(0));
        $randomHalf = $this->getMock('Randomiser');
        $randomHalf->expects($this->any())
                   ->method('generate')
                   ->will($this->returnValue(0.5));
        $randomOne = $this->getMock('Randomiser');
        $randomOne->expects($this->any())
                  ->method('generate')
                  ->will($this->returnValue(1));
        $this->randomSwordsmanFactory = new CombatantFactory($randomZero);
        $this->randomBruteFactory     = new CombatantFactory($randomHalf);
        $this->randomGrapplerFactory  = new CombatantFactory($randomOne);
    }

    /**
     * @test
     * @covers CombatantFactory::createSwordsman
     * @covers CombatantFactory::createBrute
     * @covers CombatantFactory::createGrappler
     */
    public function canCreateAllTypes() {
        // Creating directly, doesn't matter which factory we use
        $this->assertInstanceOf('Swordsman', $this->randomSwordsmanFactory->createSwordsman());
        $this->assertInstanceOf('Brute',     $this->randomSwordsmanFactory->createBrute());
        $this->assertInstanceOf('Grappler',  $this->randomSwordsmanFactory->createGrappler());
    }

    /**
     * @test
     * @covers CombatantFactory::createRandom
     */
    public function canCreateAllTypesRandomly() {
        // Use rigged factories to check we get expected "random" results
        $this->assertInstanceOf('Swordsman', $this->randomSwordsmanFactory->createRandom());
        $this->assertInstanceOf('Brute',     $this->randomBruteFactory->createRandom());
        $this->assertInstanceOf('Grappler',  $this->randomGrapplerFactory->createRandom());
    }
}

