<?php //namespace BattleSimulatorTests; @todo: work out how to get phpunit to work with namespaces

require_once('lib/robin/Random/Randomiser.php');
require_once('lib/robin/BattleSimulator/Attack.php');

abstract class CombatantTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        // Use mock randomisers to create predictable values
        $this->zeroRandomiser = new Randomiser(0);
        $this->oneRandomiser = new Randomiser(1);

        // Create lowest and highest possible combatants, and a random one
        $this->weakCombatant   = $this->createCombatant('phil', $this->zeroRandomiser);
        $this->strongCombatant = $this->createCombatant('steve', $this->oneRandomiser);
        $this->randomCombatant = $this->createCombatant('chips');
    }

    
    /**
     * @test
     * @covers Combatant::getHealth
     */
    public function healthIsBetweenParameters() {
        $weakHealth   = $this->weakCombatant->getHealth();
        $strongHealth = $this->strongCombatant->getHealth();
        $randomHealth = $this->randomCombatant->getHealth();
        
        $this->assertEquals($this->attributes['health']['lower'], $weakHealth);
        $this->assertEquals($this->attributes['health']['upper'], $strongHealth);
        $this->assertLessThanOrEqual($this->attributes['health']['upper'], $randomHealth);
        $this->assertGreaterThanOrEqual($this->attributes['health']['lower'], $randomHealth);
    }
    
    /**
     * @test
     * @covers Combatant::getStrength
     */
    public function strengthIsBetweenParameters() {
        $weakAttack   = $this->weakCombatant->getStrength();
        $strongAttack = $this->strongCombatant->getStrength();
        $randomAttack = $this->randomCombatant->getStrength();
        
        $this->assertEquals($this->attributes['strength']['lower'], $weakAttack);
        $this->assertEquals($this->attributes['strength']['upper'], $strongAttack);
        $this->assertLessThanOrEqual($this->attributes['strength']['upper'], $randomAttack);
        $this->assertGreaterThanOrEqual($this->attributes['strength']['lower'], $randomAttack);
    }
    
    /**
     * @test
     * @covers Combatant::getDefence
     */
    public function defenceIsBetweenParameters() {
        $weakDefence   = $this->weakCombatant->getDefence();
        $strongDefence = $this->strongCombatant->getDefence();
        $randomDefence = $this->randomCombatant->getDefence();
        
        $this->assertEquals($this->attributes['defence']['lower'], $weakDefence);
        $this->assertEquals($this->attributes['defence']['upper'], $strongDefence);
        $this->assertLessThanOrEqual($this->attributes['defence']['upper'], $randomDefence);
        $this->assertGreaterThanOrEqual($this->attributes['defence']['lower'], $randomDefence);
    }
    
    /**
     * @test
     * @covers Combatant::getSpeed
     */
    public function speedIsBetweenParameters() {
        $weakSpeed   = $this->weakCombatant->getSpeed();
        $strongSpeed = $this->strongCombatant->getSpeed();
        $randomSpeed = $this->randomCombatant->getSpeed();
        
        $this->assertEquals($this->attributes['speed']['lower'], $weakSpeed);
        $this->assertEquals($this->attributes['speed']['upper'], $strongSpeed);
        $this->assertLessThanOrEqual($this->attributes['speed']['upper'], $randomSpeed);
        $this->assertGreaterThanOrEqual($this->attributes['speed']['lower'], $randomSpeed);
    }
    
    /**
     * @test
     * @covers Combatant::getLuck
     */
    public function luckIsBetweenParameters() {
        $weakLuck = $this->weakCombatant->getLuck();
        $strongLuck = $this->strongCombatant->getLuck();
        $randomLuck = $this->randomCombatant->getLuck();
        
        $this->assertEquals($this->attributes['luck']['lower'], $weakLuck);
        $this->assertEquals($this->attributes['luck']['upper'], $strongLuck);
        $this->assertLessThanOrEqual($this->attributes['luck']['upper'], $randomLuck);
        $this->assertGreaterThanOrEqual($this->attributes['luck']['lower'], $randomLuck);
    }
    
    /**
     * @test
     * @covers Combatant::getName
     */
    public function canGetName() {
         $this->assertEquals('phil', $this->weakCombatant->getName());
         $this->assertEquals('steve', $this->strongCombatant->getName());
         $this->assertEquals('chips', $this->randomCombatant->getName());
    }
     
     /**
      * @test
      * @covers Combatant::setName
      * @expectedException CombatantNameLengthException
      */
    public function longNameGeneratesException() {
        $longName = 'This is one ridiculously long name, so help me god it is. Derpty derpitty herp derp.';
        $this->createCombatant($longName);
    }
    
    /**
     * @test
     * @covers Combatant::createAttack
     */
    public function canAttack() {
        $attack = $this->weakCombatant->createAttack();
        $expectedAttack = new Attack($this->weakCombatant->getStrength());
        
        $this->assertInstanceOf('Attack', $attack);
        
        $this->assertEquals($expectedAttack, $attack);
    }
    
    /**
     * @test
     * @covers Combatant::receiveAttack
     */
    public function canReceiveNonFatalAttack() {
        // Generate attack - Note weak combatant will never dodge an attack (because we rigged the Randomiser)
        $expectedDamage = $this->weakCombatant->getHealth() - 1; // Do just less than the fatal amount of damage
        $attackStrength = $this->weakCombatant->getDefence() + $expectedDamage;
        $attack = new Attack($attackStrength);
        // Perform attack
        $attack = $this->weakCombatant->receiveAttack($attack);
        
        // Check response was an attack object
        $this->assertInstanceOf('Attack', $attack);
        // Check amount of damage
        $this->assertEquals($expectedDamage, $attack->getDamage());
        // Check it's not a stunning attack
        $this->assertFalse($attack->isStunning());
        // Check it's not a killing attack
        $this->assertFalse($attack->isKilling());
        // Check we have exactly one health left
        $this->assertEquals(1, $this->weakCombatant->getHealth());
    }

    /**
     * @test
     * @covers Combatant::receiveAttack
     */
    public function canReceiveFatalAttack() {
        $healthBefore =  $this->weakCombatant->getHealth();

        // Do just more than the fatal amount of damage
        $attack = new Attack($this->weakCombatant->getDefence() + $this->weakCombatant->getHealth() + 1);
        $attack = $this->weakCombatant->receiveAttack($attack);

        // Check attack was killing
        $this->assertTrue($attack->isKilling());
        // Check damage is exactly the amount of health we had
        $this->assertEquals($healthBefore, $attack->getDamage());
    }

    /**
     * @test
     * @covers Combatant::receiveAttack
     */
    public function canDodgeAttack() {
        // Note - strong combatant will always dodge an attack because we rigged the randomiser
        $attack = new Attack(10);
        $attack = $this->strongCombatant->receiveAttack($attack);
        $this->assertTrue($attack->hasMissed());
        $this->assertEquals(0, $attack->getDamage());
    }
    
    /**
     * @test
     * @covers Combatant::receiveBlow
     */
    public function canReceiveNonFatalRetaliation() {
        $retaliationDamage = $this->weakCombatant->getHealth() - 1;
        $retaliation = new Retaliation($retaliationDamage);
        $healthBefore = $this->weakCombatant->getHealth();
        $retaliation = $this->weakCombatant->receiveBlow($retaliation);
        $this->assertFalse($retaliation->isKilling());
        $this->assertEquals($retaliationDamage, $retaliation->getDamage());
    }

    /**
     * @test
     * @covers Combatant::receiveBlow
     */
    public function canReceiveFatalRetaliation() {
        $retaliationDamage = $this->weakCombatant->getHealth() + 1;
        $retaliation = new Retaliation($retaliationDamage);
        $healthBefore = $this->weakCombatant->getHealth();
        $retaliation = $this->weakCombatant->receiveBlow($retaliation);
        $this->assertTrue($retaliation->isKilling());
        $this->assertEquals($healthBefore, $retaliation->getDamage());
    }
}

