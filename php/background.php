<?php
class Background{
    private $feature;
    private $personalityTrait;
    private $ideal;
    private $bond;
    private $flaw;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function Generate($personality){
        $myQuery = "SELECT backgrounds.description FROM backgrounds WHERE personality=".$personality." AND type=1";
        $that = $this->conn->query($myQuery);
        $this->feature = $that->fetch_assoc()["description"];

        $myQuery = "SELECT backgrounds.description FROM backgrounds WHERE personality=".$personality." AND type=2 ORDER BY RAND() LIMIT 1";
        $that = $this->conn->query($myQuery);
        $this->personalityTrait = $that->fetch_assoc()["description"];

        $myQuery = "SELECT backgrounds.description FROM backgrounds WHERE personality=".$personality." AND type=3 ORDER BY RAND() LIMIT 1";
        $that = $this->conn->query($myQuery);
        $this->ideal = $that->fetch_assoc()["description"];

        $myQuery = "SELECT backgrounds.description FROM backgrounds WHERE personality=".$personality." AND type=4 ORDER BY RAND() LIMIT 1";
        $that = $this->conn->query($myQuery);
        $this->bond = $that->fetch_assoc()["description"];

        $myQuery = "SELECT backgrounds.description FROM backgrounds WHERE personality=".$personality." AND type=5 ORDER BY RAND() LIMIT 1";
        $that = $this->conn->query($myQuery);
        $this->flaw = $that->fetch_assoc()["description"];

        //echo "feature->".$this->feature."<br><br>personality trait->".$this->personalityTrait.
        //"<br><br>ideal->".$this->ideal."<br><br>bond->".$this->bond."<br><br>flaw->".$this->flaw;
    }

    function GetBackground(){
        return [
            "feature" => $this->feature,
            "personalityTrait" => $this->personalityTrait,
            "ideal" => $this->ideal,
            "bond" => $this->bond,
            "flaw" => $this->flaw
        ];
    }

}
?>