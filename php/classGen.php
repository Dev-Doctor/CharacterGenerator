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
    private $sel_class;

    private $scores;

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
     * @return {} ritorna la classe del personaggio
     */
    public function Generate() {
        if ($this->sel_class == -1 || $this->sel_class == NULL) {
            /*if (rand(0, 1)) {
                // Se sel_class è -1 la classe sarà generata randomicamente
                return $this->generateClassRandom();
            } else {*/
                // Altrimenti sel_class conterrà l'ID della classe da ritornare 
                return $this->generateClassDetermed($this->scores);
            //}
        } else {
            $this->generateClassID($this->sel_class);
        }
    }

    /**
     *  Genera la classe random del personaggio
     * @return {} ritorna la query generata contenente la classe del personaggio
     */
    private function generateClassRandom() {
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

    /**
     *  Sceglie una classe per il personaggio
     * @param {} scores Abilità del personaggio
     * @return {} ritorna la query generata contenente la classe del personaggio
     */
    private function generateClassDetermed($scores) {
        // Scelgo quale razza in base alle scores e faccio la query
        $ID = $this->scegliClasse($scores);
        // Se id è -30 c'è un errore
        if ($ID == -30) {
            return -30;
        }

        $queryClass = "SELECT * FROM classes WHERE ID = '$ID'";
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

    /**
     *  Sceglie una classe per il personaggio
     * @param {} scores Abilità del personaggio
     * @return {} ritorna l'id della clsse
     */
    private function scegliClasse($scores) {
        // SCORES: Strength(0), Dexterity(1), Constitution(2), Intelligence(3), Wisdom(4), Charisma(5)

        // CLASSES: Strength(1), Charisma(2), Wisdom(3), Wisdom(4), Strength or Dexterity(5), Dexterity & Wisdom(6),
        //          Strength & Charisma(7), Dexterity & Wisdom(8), Dexterity(9), Charisma(10), Charisma(11), Intelligence(12)

        $max = $scores[0];
        $Imax = 0;
        $max2 = 0;
        $Imax2 = 0;

        for ($i = 1; $i < count($scores); $i++) {
            if ($i != 2) {
                if ($max < $scores[$i]) {
                    $max = $scores[$i];
                    $Imax = $i;
                } else if ($max2 < $scores[$i]) {
                    $max2 = $scores[$i];
                    $Imax2 = $i;
                }
            }
        }

        if (($Imax == 0 && $Imax2 == 1) || $Imax == 1 && $Imax2 == 0) {
            // Fighter (5)
            return 5;
        } else if (($Imax == 1 && $Imax2 == 4) || ($Imax == 4 && $Imax2 == 1)) {
            switch (rand(0, 1)) {
                case 0:
                    // Monk (6)
                    return 6;
                    break;
                case 1:
                    // Ranger (8)
                    return 8;
                    break;
            }
        } else if (($Imax == 0 && $Imax2 == 5) || ($Imax == 5 && $Imax2 == 0)) {
            // Monk (7)
            return 7;
        } else if ($Imax == 0) {
            // Barbarian (1)
            return 1;
        } else if ($Imax == 1) {
            // Rogue (9)
            return 9;
        } else if ($Imax == 3) {
            // Rogue (12)
            return 12;
        } else if ($Imax == 4) {
            switch (rand(0, 1)) {
                case 0:
                    // Cleric (3)
                    return 3;
                    break;
                case 1:
                    // Druid (4)
                    return 4;
                    break;
            }
        } else if ($Imax == 5) {
            switch (rand(0, 2)) {
                case 0:
                    // Bard (2)
                    return 2;
                    break;
                case 1:
                    // Sorcerer (10)
                    return 10;
                    break;
                case 2:
                    // Warlock (11)
                    return 11;
                    break;
            }
        } else {
            return -30;
        }
    }

    /**
     *  Sceglie una classe in base all'ID
     * @param {} ID della classe
     * @return {} ritorna la query generata contenente la classe del personaggio
     */
    private function generateClassID($ID) {
        // Scelgo quale razza in base all'iD
        $queryClass = "SELECT * FROM classes WHERE ID = '$ID'";
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

    /**
     * Setta la variabile sel_class
     * @param {Int} Variabile che contiene l'ID della classe o -1, nell'ultimo caso l'ID della classe sarà random
     */
    public function setSel_class($sel_class) {
        $this->sel_class = $sel_class;
    }

    /**
     * Setta la variabile scores
     * @param {Array[int]} Contiene le abilità del personaggio
     */
    public function setScores($scores) {
        $this->scores = $scores;
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
