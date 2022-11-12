<?php
class GenerateNames
{
  public $name;

  /**
   * [FUNZIONE TEMPORANEA] Genera il sesso del personaggio
   * @return {String} ritorna il genere del personaggio
   */
  function randomGender()
  {
    $gender = rand(1, 2);

    // 1 è maschio, 2 è femmina o 3 per neutrale
    switch ($gender) {

      case 1:
        return "male";
        break;

      case 2:
        return "female";
        break;

      case 3:
        return "neutral";
        break;

      default:
        return -30;
        break;
    }
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
    
  }

  /**
   * Genera il cognome in base alla razza
   * @param {} conn
   * @param {String} race razza del personaggio
   * @return {String} ritorna il cognome del personaggio
   */
  function generateLastname($conn, $race)
  {
    
  }
}

// Andranno messi come parametro nella funzione
$generateNames = new GenerateNames();
$race = "elf";
$gender = $generateNames->randomGender();
if ($gender == -30) {
  return -30;
}
//

/* Genera nome e cognome
$name = $generateNames->generateName($race, $gender);
$lastname = $generateNames->generateLastname($race);
if ($name == -30 || $lastname == -30) {
  return -30;
}*/
