<?php //namespace Random; @todo: work out how to get phpunit to work with namespaces

class Randomiser {
    private $fixedValue = null;

    public function __construct($fixedValue = null) {
        $this->fixedValue = $fixedValue;
    }

    public function generate() {
        return isset($this->fixedValue) ? $this->fixedValue : mt_rand() / mt_getrandmax();
    }

    /**
     * @param float $chance The chance of getting "true". Defaults to half.
     * @return boolean
     */
    public function generateBoolean($chance = null) {
        $chance = isset($chance) ? $chance : 0.5;
        return $this->generate() > 1 - $chance;
    }

    public function getArrayItem(Array $array) {
        $key = floor($this->generate() * count($array));
        // Should never be more than the count - will very rarely happen
        if($key == count($array)) {$key--;}
        return $array[$key];
    }
}

