<?php
include 'ability_scores.php';
include 'identity.php';
include 'race_select.php';
include 'gender.php';
include 'traits.php';
include 'classGen.php';
include 'background.php';
include 'personality.php';

class Character {
    private $ability_scores;
    private $idenity;
    private $race;
    private $gender;
    private $traits;
    private $class;
    private $background;
    private $personality;

    public $sel_abilities;
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
        $this->ability_scores = new Ability_Scores();
        $this->race = new Race($conn);
        $this->identity = new GenerateNames($conn);
        $this->gender = new Gender();
        $this->traits = new Traits($conn);
        $this->class = new GenerateClass($conn);
        $this->background = new Background($conn);
        $this->personality = new Personality($conn);
    }

    public function Generate() {
        // GENERATE ABILITY SCORES
        $this->ability_scores->Generate();

        // GENERATE RACE
        $this->race->PickRace();

        // GENERATE NAME AND LASTNAME
        if ($this->race->GetRaceMainRaceID() == null) {
            $this->identity->SetParams($this->race->GetRaceID(), $this->gender->GetGenderNumber());
        } else {
            $this->identity->SetParams($this->race->GetRaceMainRaceID(), $this->gender->GetGenderNumber());
        }
        if($this->race->GetRaceNeutralNames()) {
            $this->identity->gender = 1;
        }

        $this->identity->Generate();

        // GENERATE TRAITS
        $this->traits->Generate($this->race->GetRaceID());

        // GENERATE CLASS
        $this->class->setScores($this->ability_scores->GetScores());
        $this->class->Generate();

        // GENERATE PERSONALITY
        $this->personality->Generate();

        // GENERATE BACKGROUND 
        $this->background->Generate($this->personality->GetPersonalityData()["id"]);
    }
    // IDENTITY VALUES
    public function GetName() {
        return $this->identity->getName();
    }

    public function GetLastname() {
        return $this->identity->getLastname();
    }

    public function GetGender() {
        return $this->gender->GetGender();
    }

    public function SetGender($gn) {
        if ($gn == 'R') {
            return;
        }

        $this->gender->SetGender(intval($gn));
    }

    // RACE VALUES
    public function GetRaceName() {
        return $this->race->GetRaceName();
    }

    public function GetMainRaceID() {
        return $this->race->GetRaceMainRaceID();
    }

    public function SetSelectedRace($sel) {
        $this->race->sel_race = $sel;
    }

    public function GetRacialTraits() {
        return $this->race->GetRacialTraits();
    }

    // TRAITS VALUES
    public function GetTraits() {
        return $this->traits->GetTraits();
    }

    public function SetSelectedAbilities($sel) {
        $this->ability_scores->sel_abilities = $sel;
    }

    // ABILITY SCORES VALUES
    public function GetAbilityScores() {
        return $this->ability_scores->GetScores();
    }

    // CLASS VALUES
    public function GetClassArray() {
        return [
            "name" => $this->class->getName(),
            "desc" => $this->class->getDescription(),
            "hit_dice" => $this->class->getHit_dice(),
            "primary" => $this->class->getPrimary_ability(),
            "throws" => $this->class->getSaving_throws(),
            "armor_weapons" => $this->class->getArmor_weapons()
        ];
    }

    public function SetSelectedClass($cl) {
        $this->class->setSel_class($cl);
    }

    // PERSONALITY VALUES
    public function GetPersonalityValues() {
        return $this->personality->GetPersonalityData();
    }

    public function SetSelectedPersonality($pers) {
        $this->personality->sel_personality = $pers;
    }

    // GET BACKGROUND VALUES
    public function GetBackgrounds() {
        return $this->background->GetBackground();
    }

    // DEVELOPMENT ONLY
    /*
    public function VisualizeAll() {
        $this->ability_scores->Visualize();
    }
    */
}
