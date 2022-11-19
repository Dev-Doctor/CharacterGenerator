<?php
class GenerateNames
{

  /**
   *  Costruttore
   * @param {} conn
   * @return {String[]} ritorna un array di tipo stringa con in posizione 0 il nome e in posizione 1 il cognome 
   */
  function __construct($conn)
  {
    // Dati che verranno generati da un alta parte e passati
    $race = 2;
    $gender = 1;
    //

    $name = $this->generateName($conn, $race, $gender);
    if ($name == -30) {
      echo "Nessun nome";
      return -30;
    }

    echo ("Name: " . $name);

    /*$lastname = $this->generateLastname($conn, $race);
    if ($lastname == -30) {
      echo "Nessun cognome";
      return -30;
    }*/
  }

  /**
   *  Genera il nome in base alla razza e il genere
   * @param {} conn
   * @param {String} race razza del personaggio
   * @param {String} gender genere del personaggio
   * @return {String} ritorna il nome del personaggio
   */
  function generateName($conn, $race, $gender)
  {
    // Faccio una query di tutti i nomi di una determinata razza e genere
    $queryNames = "SELECT * FROM names WHERE race = '$race' AND gender = '$gender'";
    $resultNames = $conn->query($queryNames);
    // Contollo che il numero di nomi trovati sia maggiore di 0
    if ($resultNames->num_rows <= 0) {
      return -30;
    }
    
    // Prendo l'ID del primo nome trovato che sarà il numero minimo nel random
    $IDstart = $resultNames->fetch_assoc()["ID"];

    // Random inter $min = $IDstart(ID del primo nome di $queryNames),
    // $max = $IDstart + $resultNames->num_rows(numero di nomi trovati nella query $queryNames) - 1
    $randInt = random_int($IDstart, $IDstart + $resultNames->num_rows - 1);

    // Query 2
    $queryNameFromNames = "SELECT * FROM ($queryNames) AS q1 WHERE ID = '$randInt'";
    $resultName = $conn->query($queryNameFromNames);
    // Contollo che il numero di nomi trovati sia 1
    if ($resultName->num_rows != 1) {
      return -30;
    }

    /*$row = $resultName->fetch_assoc();
    $this->console_log($resultName->fetch_assoc());
    echo "ID: " . $row["ID"] . " - Name: " . $resultName->fetch_assoc()["name"] . "<br>";*/

    // Return del nome con ID casuale
    return $resultName->fetch_assoc()["name"];
  }

  /**
   * Genera il cognome in base alla razza
   * @param {} conn
   * @param {String} race razza del personaggio
   * @return {String} ritorna il cognome del personaggio
   */
  function generateLastname($conn, $race)
  {
    return "";
  }

  /**
   *  Funzione per debug, scrive su console
   * @param {} output è il messaggio da scrivere
   */
  function console_log($output, $with_script_tags = true)
  {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
  }
}
