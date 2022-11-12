<?php
include 'dice.php';
class Traits{
    private $height;
    private $weight;
    private $age;
    private $eyes;
    private $skin;
    private $hair;

    /**
     * Genera i tratti avanzati del personaggio in base alla razza: altezza, peso, età, colore occhi/pelle/capelli
     * @param  {Object} conn connessione al database
     * @param  {Number} raceID ID della razza all'interno del database
     * @return {Object} array contenente tutti i tratti appena generati
     */
    function Generate($conn, $raceID){
        $myQuery = "SELECT races.ID, traits.BaseHeight, traits.HeightModifier, traits.BaseWeight, traits.WeightModifier, traits.MinAge, traits.MaxAge, traits.eyes_colors, traits.skin_colors, traits.hair_colors FROM races INNER JOIN traits ON races.ID=traits.ID WHERE races.ID = " . $raceID;
        $that = $conn->query($myQuery);
        $race = $that->fetch_assoc();

        $this->age=rand($race["MinAge"], $race["MaxAge"]);
        $colors=$race["eyes_colors"];
        $this->eyes=$colors[rand(0, count($colors))];
        $colors=$race["skin_colors"];
        $this->skin=$colors[rand(0, count($colors))];
        $colors=$race["hair_colors"];
        $this->hair=$colors[rand(0, count($colors))];
        
        $this->height=$race["BaseHeight"]+rollDice($race["HeightModifier"]);
        $this->weight=$race["BaseWeight"]*rollDice($race["WeightModifier"]);

        echo ("height:".$this->height." weight:".$this->weight." age: ".$this->age." eyes:".$this->eyes." skin:".$this->skin." hair:".$this->hair);
    }

}
