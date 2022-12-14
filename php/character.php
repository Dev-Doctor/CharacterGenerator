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
        if (rand(0, 1)) {
            //echo "Determed -> ";
            $this->ability_scores->GenerateDetermed();
        } else {
            //echo "Random -> ";
            $this->ability_scores->Generate();
        }

        /* --------------- GENERATE RACE --------------- */
        $this->race->PickRace();
        //echo $this->race->GetRaceID() . " | " . $this->race->GetRaceName();

        /* --------------- GENERATE GENDER --------------- */
        //echo $this->gender->GetGenderNumber();

        /* --------------- GENERATE NAME AND LASTNAME --------------- */
        if ($this->race->GetRaceMainRaceID() == null) {
            $this->identity->SetParams($this->race->GetRaceID(), $this->gender->GetGenderNumber());
        } else {
            $this->identity->SetParams($this->race->GetRaceMainRaceID(), $this->gender->GetGenderNumber());
        }
        $this->identity->SetParams(16, $this->gender->GetGenderNumber()); /* !!! PROBLEM !!! */
        $this->identity->Generate();
        //echo "Name: " . $this->identity->getName() . " | Lastname: " . $this->identity->getLastname();

        /* --------------- GENERATE TRAITS --------------- */
        $this->traits->Generate($this->race->GetRaceID());
    }
    /* --------------- IDENTITY VALUES --------------- */
    public function GetName() {
        return $this->identity->getName();
    }

    public function GetLastname() {
        return $this->identity->getLastname();
    }

    public function GetGender() {
        return $this->gender->GetGender();
    }

    /* --------------- RACE VALUES --------------- */
    public function GetRaceName() {
        return $this->race->GetRaceName();
    }

    public function GetMainRaceID() {
        return $this->race->GetRaceMainRaceID();
    }

    public function SetSelectedRace($sel) {
        $this->race->sel_race = $sel;
    }

    /* --------------- TRAITS VALUES --------------- */
    public function GetTraits() {
        return $this->traits->GetTraits();
    }
    /* --------------- ABILITY SCORES VALUES --------------- */
    public function GetAbilityScores() {
        return $this->ability_scores->GetScores();
    }

    /* --------------- DEVELOPMENT ONLY --------------- */
    public function VisualizeAll() {
        $this->ability_scores->Visualize();
    }
}
