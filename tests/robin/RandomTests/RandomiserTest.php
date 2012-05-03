<?php //namespace RandomTests; @todo: work out how to get phpunit to work with namespaces

class RandomiserTest extends PHPUnit_Framework_TestCase {
    private $defaultTries = 5;
    private $testArray    = ['itemone', 'itemtwo', 'itemthree'];

    public function setUp() {
        $this->randomRandomiser = new Randomiser();
        $this->oneRandomiser    = new Randomiser(1);
        $this->zeroRandomiser   = new Randomiser(0);
        $this->halfRandomiser   = new Randomiser(0.5);
        $this->justOverHalfRandomiser = new Randomiser(0.51);
    }
    
    /**
     * @test
     * @covers Randomiser::generate
     */
    public function generatesRandomNumbersBetweenZeroAndOne() {
        $randomNumber = $this->randomRandomiser->generate();
        $anotherRandomNumber = $this->randomRandomiser->generate();

        for($i=0; $i<$this->defaultTries; $i++) {
            if($anotherRandomNumber != $randomNumber) {break;} 
            $anotherRandomNumber = $this->randomRandomiser->generate();
        }

        $this->assertGreaterThanOrEqual(0, $randomNumber);
        $this->assertGreaterThanOrEqual(0, $anotherRandomNumber);
        $this->assertLessThanOrEqual(1, $randomNumber);
        $this->assertLessThanOrEqual(1, $anotherRandomNumber);
        $this->assertNotEquals($randomNumber, $anotherRandomNumber);
    }

    /**
     * @test
     * $covers Randomiser::generate
     */
    public function canFixRandomisers() {
        for($i=0; $i<$this->defaultTries; $i++) {
            $this->assertEquals(1, $this->oneRandomiser->generate());
            $this->assertEquals(0, $this->zeroRandomiser->generate());
            $this->assertEquals(0.5, $this->halfRandomiser->generate());
        }
    }

    /**
     * @test
     * @covers Randomiser::generateBoolean
     */
    public function generatesRandomBooleans() {
        $boolean = $this->randomRandomiser->generateBoolean();
        $anotherBoolean = $this->randomRandomiser->generateBoolean();

        for($i=0; $i<$this->defaultTries*2; $i++) {
            if($anotherBoolean != $boolean) {break;}
            $anotherBoolean = $this->randomRandomiser->generateBoolean();
        }

        $this->assertTrue(is_bool($boolean));
        $this->assertTrue(is_bool($anotherBoolean));
        $this->assertNotEquals($boolean, $anotherBoolean);
    }

    /**
     * @test
     * @covers Randomiser::generateBoolean
     */
    public function generatesRiggedBooleans() {
        for($i=0; $i<$this->defaultTries; $i++) {
            $this->assertTrue($this->oneRandomiser->generateBoolean());
            $this->assertFalse($this->zeroRandomiser->generateBoolean());
            $this->assertFalse($this->halfRandomiser->generateBoolean());
            $this->assertTrue($this->justOverHalfRandomiser->generateBoolean());
        }
    }

    /**
     * @test
     * @covers Randomiser::getArrayItem
     */
    public function canGetRandomArrayItems() {
        $item        = $this->randomRandomiser->getArrayItem($this->testArray);
        $anotherItem = $this->randomRandomiser->getArrayItem($this->testArray);

        for($i=0; $i<$this->defaultTries; $i++) {
            $testItem = $this->randomRandomiser->getArrayItem($this->testArray);
            $this->assertTrue(in_array($testItem, $this->testArray));
            if($anotherItem == $item && $testItem != $item) {
                $anotherItem = $testItem;
            }
        }

        $this->assertNotEquals($item, $anotherItem);
    }

    /**
     * @test
     * @covers Randomiser::getarrayItem
     */
    public function canGetRiggedArrayItems() {
        // This test expects an array of 3 items
        $this->assertEquals(3, count($this->testArray));

        for($i=0; $i<$this->defaultTries; $i++) {
            $this->assertEquals($this->testArray[0], $this->zeroRandomiser->getArrayItem($this->testArray));
            $this->assertEquals($this->testArray[1], $this->halfRandomiser->getArrayItem($this->testArray));
            $this->assertEquals($this->testArray[2], $this->oneRandomiser->getArrayItem($this->testArray));
        }
    }
}

