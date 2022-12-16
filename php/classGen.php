<?php
class GenerateClass {

    private $class = "";
    private $name = "";
    private $description = "";
    private $hit_dice = "";
    private $primary_ability = "";
    private $saving_throws;
    private $armor_weapons;
    private $conn;

    /**
     *  Costruttore
     * @param {} conn
     */
    function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     *  Genera la classe del personaggio
     * @param {} conn
     * @return {} ritorna la query generata contenente la classe del personaggio
     */
    public function Generate() {
        // Faccio una query di tutti i nomi di una determinata razza e genere, li randomizzo e ne prendo 1
        $queryClass = "SELECT * FROM classes ORDER BY RAND() LIMIT 1";
        $result = $this->conn->query($queryClass);
        // Contollo che abbia trovato qualcosa
        if ($result->num_rows <= 0) {
            return -30;
        }
        $this->class = $result->fetch_assoc();

        // Leggo i parametri dalla query
        $this->name = $this->class["name"];
        $this->description = $this->class["description"];
        $this->hit_dice = $this->class["hit_dice"];
        $this->primary_ability = $this->class["primary_ability"];
        $this->saving_throws = $this->convertJson($this->class["saving_throws"]);
        $this->armor_weapons = $this->convertJson($this->class["armor_weapons"]);

        // Return risultato query
        return $result;
    }

    /*FUNZIONE DETERMED NON ANCORA IMPLEMENTATA*/
    /**
     *  Sceglie una classe per il personaggio in base a varie abilità
     * @param {} conn
     * @return {} ritorna la query generata contenente la classe del personaggio
     */
    private function generateClassDetermed($conn) {
        /*FUNZIONE DETERMED NON ANCORA IMPLEMENTATA*/
        // Faccio una query di tutti i nomi di una determinata razza e genere, li randomizzo e ne prendo 1
        $queryClass = "";
        $result = $conn->query($queryClass);
        // Contollo che abbia trovato qualcosa
        if ($result->num_rows <= 0) {
            return -30;
        }
        $this->class = $result->fetch_assoc();

        // Leggo i parametri dalla query
        $this->name = $this->class["name"];
        $this->description = $this->class["description"];
        $this->hit_dice = $this->class["hit_dice"];
        $this->primary_ability = $this->class["primary_ability"];
        $this->saving_throws = $this->convertJson($this->class["saving_throws"]);
        $this->armor_weapons = $this->convertJson($this->class["armor_weapons"]);

        // Return risultato query
        return $result;
        /*FUNZIONE DETERMED NON ANCORA IMPLEMENTATA*/
    }

    /**
     * Ritorna il nome dalla query generata
     * @return {String} ritorna il nome del personaggio
     */
    public function getName() {
        if ($this->name == "") {
            return "Non ancora generato.";
        }
        return $this->name;
    }

    /**
     * Ritorna il description dalla query generata
     * @return {String} ritorna il nome del personaggio
     */
    public function getDescription() {
        if ($this->description == "") {
            return "Non ancora generato.";
        }
        return $this->description;
    }

    /**
     * Ritorna il hit_dice dalla query generata
     * @return {String} ritorna il nome del personaggio
     */
    public function getHit_dice() {
        if ($this->hit_dice == "") {
            return "Non ancora generato.";
        }
        return $this->hit_dice;
    }

    /**
     * Ritorna il primary_ability dalla query generata
     * @return {String} ritorna il nome del personaggio
     */
    public function getPrimary_ability() {
        if ($this->primary_ability == "") {
            return "Non ancora generato.";
        }
        return $this->primary_ability;
    }

    /**
     * Ritorna il saving_throws dalla query generata
     * @return {String} ritorna il nome del personaggio
     */
    public function getSaving_throws() {
        if ($this->saving_throws == "") {
            return "Non ancora generato.";
        }
        return $this->saving_throws;
    }

    /**
     * Ritorna il armor_weapons dalla query generata
     * @return {String} ritorna il nome del personaggio
     */
    public function getArmor_weapons() {
        if ($this->armor_weapons == "") {
            return "Non ancora generato.";
        }
        return $this->armor_weapons;
    }

    /**
     * Converte una struttura json e ritorta un array
     * @return {String} ritorna un array
     */
    function convertJson($json) {
        $result = json_decode($json, true);
        if ($result == NULL) {
            return "Errore valore NULL.";
        }
        return $result;
    }

    /**
     *  Funzione per debug, scrive su console
     * @param {} output è il messaggio da scrivere
     */
    public function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
}
