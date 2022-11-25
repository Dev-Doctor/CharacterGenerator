<?php
include 'ability_scores.php';
include 'identity.php';
include 'race_select.php';
include 'gender.php';
include 'traits.php';

class Character {    
    private $ability_scores;
    private $idenity;
    private $race;
    private $gender;
    private $traits;

    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
        $this->ability_scores = new Ability_Scores();
        $this->race = new Race($conn);
        $this->identity = new GenerateNames($conn);
        $this->gender = new Gender();
        $this->traits = new Traits($conn);
    }

    public function Generate() {
        /* --------------- GENERATE ABILITY SCORES --------------- */
        echo "Ability Scores -> ";
        if(rand(0, 1)) {
            echo "Determed -> ";
            $this->ability_scores->GenerateDetermed();
        } else {
            echo "Random -> ";
            $this->ability_scores->Generate();
        }
        echo $this->ability_scores->Visualize();
        /* --------------- GENERATE RACE --------------- */ echo "<br>";
        $this->race->PickRace();
        echo $this->race->GetRaceID() . " | " . $this->race->GetRaceName();
        /* --------------- GENERATE GENDER --------------- */ echo "<br>";
        echo $this->gender->GetGenderNumber();
        /* --------------- GENERATE NAME AND LASTNAME --------------- */ echo "<br>";
        if($this->race->GetRaceMainRaceID() == null) {
            $this->identity->SetParams($this->race->GetRaceID(), $this->gender->GetGenderNumber());
        } else {
            $this->identity->SetParams($this->race->GetRaceMainRaceID(), $this->gender->GetGenderNumber());
        }
        $this->identity->SetParams(16, $this->gender->GetGenderNumber()); /* !!! PROBLEM !!! */
        $this->identity->Generate();
        echo "Name: " . $this->identity->getName() . " | Lastname: " . $this->identity->getLastname();
        /* --------------- GENERATE TRAITS --------------- */ echo "<br>";
        $this->traits->Generate($this->race->GetRaceID());
        /* --------------- GENERATE TRAITS --------------- */ echo "<br>";
    }

    public function VisualizeAll() {
        $this->ability_scores->Visualize();
    }

    public function GetAbilityScores() {
        return $this->ability_scores->GetScores();
    }

    
}