<?php
include 'php/ability_scores.php';

class Character {
    private $ability_scores;

    function __construct() {
        $this->ability_scores = new Ability_Scores();
    }

    public function Generate() {
        echo "Ability Scores -> ";
        if(rand(0, 1)) {
            echo "Determed -> ";
            $this->ability_scores->GenerateDetermed();
        } else {
            echo "Random -> ";
            $this->ability_scores->Generate();
        }
        $this->ability_scores->Visualize();
    }
}