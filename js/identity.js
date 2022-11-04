/**
 * Genera nome e cognome in base alla razza e il genere
 * @return {String} il nome generato virgola il cognome
 */
var IDENTITY = {
  Generate: (names) => {
    // Andranno messi come parametro nella funzione
    let race = "elf";
    let gender = randomGender();
    if (gender == -30) {
      return -30;
    }
    //

    let name = generateName(names, race, gender);

    let lastname = generateLastname(names, race);
    if (name == -30 || lastname == -30) {
      return -30;
    }

    console.log("Name:" + name + ", Lastname:" + lastname);

    return name + "," + lastname;
  }
}

/**
 * Genera un numero intero casuale
 * @param {Number} min numero minimo
 * @param {Number} max numero massimo
 * @return {Number} numero generato casualmente
 */
function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 * [FUNZIONE TEMPORANEA] Genera il sesso del personaggio
 * @return {String} ritorna il genere del personaggio
 */
function randomGender() {
  let gender = getRndInteger(1, 2);

  // 1 è maschio, 2 è femmina o 3 per neutrale
  switch (gender) {

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
 * @param {} names
 * @param {String} race razza del personaggio
 * @param {String} gender genere del personaggio
 * @return {String} ritorna il nome del personaggio
 */
function generateName(names, race, gender) {
  switch (race) {
    case "elf":
      switch (gender) {
        case "male":
          return names().elf.male[getRndInteger(0, names().elf.male.length - 1)];
          break;

        case "female":
          return names().elf.female[getRndInteger(0, names().elf.female.length - 1)];
          break;

        case "neutral":
          return names().elf.neutral[getRndInteger(0, names().elf.neutral.length - 1)];
          break;

        default:
          return -30;
          break;
      }
      break;

    default:
      return -30;
      break;
  }
}

/**
 * Genera il cognome in base alla razza
 * @param {} names
 * @param {String} race razza del personaggio
 * @return {String} ritorna il cognome del personaggio
 */
function generateLastname(names, race) {
  switch (race) {
    case "elf":
      return names().elf.lastnames_p1[getRndInteger(0, names().elf.lastnames_p1.length - 1)] + names().elf.lastnames_p2[getRndInteger(0, names().elf.lastnames_p2.length - 1)];
      break;

    default:
      break;
  }
}

/**
 * Probabilita che il genere sia neutrale
 */
//const values = [1, .15, .07, .03, .006];
/*function GetProbabiliy() {
  let probability;
  let roll = Math.random();
  for (let i = 0; i < values.length; ++i) {
      if (roll < values[i]) {
          probability = values[i];
      }
      if (probability == null) { probability = roll }
  }
  return probability;
}*/