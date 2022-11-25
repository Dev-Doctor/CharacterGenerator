<?php
class GenerateNames {

  private $name = "";
  private $lastname = "";
  private $conn;
  private $race;
  private $gender;

  /**
   *  Costruttore
   * @param {} conn
   */
  function __construct($conn) {
    $this->conn = $conn;
  }

  public function SetParams($race, $gender) {
    $this->race = $race;
    $this->gender = $gender;
  }

  public function Generate() {
    $this->name = $this->generateName($this->conn, $this->race, $this->gender);
    if ($this->name == -30) {
      //echo "Nessun nome";
      return -30;
    }

    $this->lastname = $this->generateLastname($this->conn, $this->race);
    if ($this->lastname == -30) {
      //echo "Nessun cognome";
      return -30;
    }
  }

  /**
   *  Genera il nome in base alla razza e il genere
   * @param {} conn
   * @param {Int} race razza del personaggio
   * @param {Int} gender genere del personaggio
   * @return {String} ritorna il nome del personaggio
   */
  private function generateName($conn, $race, $gender)
  {
    // Faccio una query di tutti i nomi di una determinata razza e genere, li randomizzo e ne prendo 1
    $queryName = "SELECT * FROM names WHERE race = '$race' AND gender = '$gender' ORDER BY RAND() LIMIT 1";
    $resultName = $conn->query($queryName);
    // Contollo che il numero di nomi trovati sia maggiore di 0
    if ($resultName->num_rows <= 0) {
      return -30;
    }

    // Return del nome
    return $resultName->fetch_assoc()["name"];
  }

  /**
   * Genera il cognome in base alla razza
   * @param {} conn
   * @param {Int} race razza del personaggio
   * @return {String} ritorna il cognome del personaggio
   */
  private function generateLastname($conn, $race) {
    // Faccio una query di tutti i cognomi di una determinata razza e genere, li randomizzo e ne prendo 1
    $queryLastnames = "SELECT * FROM lastnames WHERE race = '$race' ORDER BY RAND() LIMIT 1";
    $resultLastnames = $conn->query($queryLastnames);
    // Contollo che il numero di cognomi trovati sia maggiore di 0
    if ($resultLastnames->num_rows <= 0) {
      return -30;
    }

    // Return del cognome
    return $resultLastnames->fetch_assoc()["lastname"];
  }

  /**
   * Ritorna il nome generato
   * @return {String} ritorna il nome del personaggio
   */
  public function getName() {
    if ($this->name == "") {
      return "Non ancora generato.";
    }
    return $this->name;
  }

  /**
   * Ritorna il cognome generato
   * @return {String} ritorna il cognome del personaggio
   */
  public function getLastname() {
    if ($this->lastname == "") {
      return "Non ancora generato.";
    }
    return $this->lastname;
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
