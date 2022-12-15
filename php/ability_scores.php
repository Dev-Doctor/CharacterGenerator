<?php
class Ability_Scores {
    private $scores = [0, 0, 0, 0, 0, 0];
    public $sel_abilities;

    function __construct() {
    }

    public function Generate() {
        switch ($this->sel_abilities) {
            case 'S':
                if (rand(0, 1)) {
                    $this->GenerateDetermed();
                } else {
                    $this->GenerateRandom();
                }
                break;
            case 'D':
                $this->GenerateDetermed();
                break;
            case 'R':
                $this->GenerateRandom();
                break;
        }
    }

    public function GenerateRandom() {
        for ($i = 0; $i < sizeof($this->scores); $i++) {
            $this->scores[$i] = $this->Roll_4d6();
        }
    }

    public function GenerateDetermed() {
        $determed_scores = [15, 14, 13, 12, 10, 8];
        shuffle($determed_scores);

        $this->scores = $determed_scores;
    }

    private function Roll_4d6() {
        do {
            $dice_rolls = array();
            for ($i = 0; $i < 4; $i++) {
                $dice_rolls[] = rand(1, 6);
            }
            rsort($dice_rolls);
            array_pop($dice_rolls);
            $result = 0;
            for ($i = 0; $i < sizeof($dice_rolls); $i++) {
                $result += $dice_rolls[$i];
            }
        } while ($result < 8);
        return $result;
    }

    public function GetScores() {
        return $this->scores;
    }

    public function Visualize() {
        echo "[Strength: " . $this->scores[0] . "] [Dexterity: " . $this->scores[1] . "] [Constitution: " . $this->scores[2] . "] [Intelligence: " . $this->scores[3] . "] [Wisdom: " . $this->scores[4] . "] [Charisma: " . $this->scores[5] . "]<br>";
    }
}
