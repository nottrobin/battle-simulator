<?php

/**
 * A fun class for generating random words for describing (battle) Simulations
 */
class TextGenerator {
    private $randomiser;
    private $verbs           = ['flung', 'flicked', 'threw', 'slid', 'heaved', 'swung', 'fired', 'nudged'];
    private $adjectives      = ['weapon' => ['whirling', 'spinning', 'flaming', 'grinning',  'really hot', 'lancing', 'mighty', 'ice cold'],
                                'dodge'  => ['illegal', 'dazzling', 'scary', 'disappointing', 'impressive', 'blinding', 'brilliant', 'boring', 'scorn-worthy',
                                             'unacceptable', 'unbelievable', 'totally believable']
                               ];
    private $nouns           = ['fish', 'lance', 'sword', 'tree', 'shoe', 'train', 'pigeon', 'pen'];
    private $appendices      = ['death', 'meganess', 'awesomeness', 'worldliness', 'pinkness', 'doom', 'oblivion'];
    private $abstractNouns   = ['bravery', 'cowardice', 'emotion', 'not-there-ness', 'lethargy', 'campness', 'skill', 'incompetence', 'derision'];

    public function __construct(Randomiser $randomiser = null) {
        $this->setRandomiser($randomiser);
    }

    public function getVerb() {
        return $this->getWord($this->verbs, false);
    }

    public function getWeaponAdjective() {
        return $this->getWord($this->adjectives['weapon'], true);
    }

    public function getDodgeAdjective() {
        return $this->getWord($this->adjectives['dodge'], true);
    }

    public function getNoun() {
        return $this->getWord($this->nouns, false);
    }

    public function getAppendix() {
        return $this->getWord($this->appendices, false);
    }

    public function getAbstractNoun() {
        return $this->getWord($this->abstractNouns, false);
    }

    private function getWord(Array $wordSet, $definiteArticle = null) {
        $word = $this->getRandomiser()->getArrayItem($wordSet);
        if($definiteArticle) {
            $word = $this->appendDefiniteArticle($word);
        }
        return $word;
    }

    private function appendDefiniteArticle($word) {
        $firstChar = strtolower(substr($word,0,1));
        if(in_array($firstChar, ['a', 'e', 'i', 'o', 'u'])) {
            $word = 'an ' . $word;
        } else {
            $word = 'a ' . $word;
        }

        return $word;
    }

    public function setRandomiser(Randomiser $randomiser = null) {
        $this->randomiser = $randomiser;
    }

    private function getRandomiser() {
        if(!$this->randomiser instanceof Randomiser) {
            $this->randomiser = new Randomiser();
        }

        return $this->randomiser;
    }
}
