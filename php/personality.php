<?php
class personality {
    private $ID;
    private $name;
    private $conn;

    public $sel_personality;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function Generate() {
        if ($this->sel_personality == -1) {
            $theQuery = "SELECT * FROM personality ORDER BY RAND() LIMIT 1";
        } else {
            $theQuery = "SELECT * FROM personality WHERE ID= " . $this->sel_personality;
        }
        $result = $this->conn->query($theQuery)->fetch_assoc();
        $this->ID = $result["ID"];
        $this->name = $result["name"];
    }

    function GetPersonalityData() {
        return [
            "id" => $this->ID,
            "name" => $this->name
        ];
    }
}
