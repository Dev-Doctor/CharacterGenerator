<?php
class Race {
    private $conn;

    private $race;
    private $racial_traits = [
        array(),
        array()
    ];

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

        $query = "SELECT * FROM `racial_traits` WHERE race=" . $this->race["ID"];
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($this->racial_traits[0], $row["trait_name"]);
                array_push($this->racial_traits[1], $row["trait_description"]);
            }
        } else {
            echo "0 results";
        }
    }

    public function GetRacialTraits() {
        return $this->racial_traits;
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

    public function GetRaceNeutralNames() {
        return $this->race["neutral_names"];
    }

    /**
     * @deprecated
     */
    public function GetRace() {
        return $this->race;
    }
}
