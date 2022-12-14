<?php
class Race {
    private $conn;
    private $race;
    public $sel_race = NULL;

    function __construct($conn) {
        $this->conn = $conn;
    }

    public function PickRace() {
        if ($this->sel_race == null || $this->sel_race == -1) {
            $query = "SELECT * FROM `races` ORDER BY RAND() LIMIT 1";
        } else {
            $query = "SELECT * FROM `races` WHERE ID = " . $this->sel_race;
        }
        $this->race = $this->conn->query($query)->fetch_assoc();

        if ($this->race["traits"] == null) {
            $id = $this->race["ID"];
            $query = "SELECT * FROM `races` WHERE main_race = " . $id . " ORDER BY RAND() LIMIT 1";
            $this->race = $this->conn->query($query)->fetch_assoc();
        }
    }

    public function GetRaceID() {
        return $this->race["ID"];
    }

    public function GetRaceTraitsID() {
        return $this->race["traits"];
    }

    public function GetRaceMainRaceID() {
        return $this->race["main_race"];
    }

    public function GetRaceName() {
        return $this->race["name"];
    }

    /**
     * @deprecated
     */
    public function GetRace() {
        return $this->race;
    }
}
