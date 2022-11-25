<?php
class Race {
    private $conn;
    private $race;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function PickRace() {
        $query = "SELECT * FROM `races` ORDER BY RAND() LIMIT 1";
        $this->race = $this->conn->query($query)->fetch_assoc();
        if($this->race["traits"] == null) {
            $id = $this->race["ID"];
            $query = "SELECT * FROM `races` WHERE main_race = " . $id . " ORDER BY RAND() LIMIT 1";
            $this->race = $this->conn->query($query)->fetch_assoc();
        }
    }

    public function GetRaceID() {
        return $this->race["ID"];
    }

    public function GetRaceName() {
        return $this->race["name"];
    }

    public function GetRaceTraitsID() {
        return $this->race["traits"];
    }

    public function GetRaceMainRaceID() {
        return $this->race["main_race"];
    }
}
