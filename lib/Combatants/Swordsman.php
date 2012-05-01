<?php

class Swordsman extends Combatant {
    public function getAttackStrength(BooleanGenerator $boolGenerator = null) {
        // Default boolean generator to 5%
        $boolGenerator = isset($boolGenerator) ? $boolGenerator : new BooleanGenerator(0.05);

        $attackStrength = $this->strength;
        
        if($boolGenerator->generate()) {
            $attackStrength = $attackStrength * 2;
        }
        
        return $attackStrength;
    }
    
    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(40, 60);
    }
    
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(60, 70);
    }
    
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(20, 30);
    }
    
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(90, 100);
    }
    
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.5);
    }
}
