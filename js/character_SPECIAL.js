const values = [1, .15, .07, .03, .006];

/**
 * Inizia la generazione del modulo SPECIAL
 * @return {Number[]} lo SPECIAL generato
 */
var SPECIAL = {
    Generate: () => {
        let probability = GetProbabiliy();
        let modifier = CalculateModifier(probability);
        let list = GenerateSPECIAL(modifier);
        return list;
    }
}
/**
 * Randomizza un numero tra min e massimo
 * @param  {Number} min numero minimo
 * @param  {Number} max numero massimo
 * @return {Number}     il numero casuale
 */
function Random(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

/**
 * genera una probabilità utilizzando un Array costante
 * @return {Number}      la probabilità
 */
function GetProbabiliy() {
    let probability;
    let roll = Math.random();
    for (let i = 0; i < values.length; ++i) {
        if (roll < values[i]) {
            probability = values[i];
        }
        if (probability == null) { probability = roll }
    }
    return probability;
}

/**
 * Ritorna un valore diverso a seconda della probabilità
 * @param  {Number} probability probabilità da controllare
 * @return {Number} 0
 * @return {Number} Casuale tra 1 e 5
 * @return {Number} Casuale tra 5 e 9
 * @return {Number} 10
 * @return {Number} 42
 */
function CalculateModifier(probability) {
    switch (probability) {
        case values[0]:
            return 0;

        case values[1]:
            return 0;

        case values[2]:
            return Random(1, 5);

        case values[3]:
            return Random(5, 9);

        case values[4]:
            return 10;

        case values[5]:
            return 42;

        default:
            console.log("WHY WTF");
            return 0;
    }
}

/**
 * Genera lo S.P.E.C.I.A.L. a seconda del modificatore
 * @param  {Number} modifier modificatore che deve essere sommato al risultato
 */
function GenerateSPECIAL(modifier) {
    var list = [1, 1, 1, 1, 1, 1, 1];
    for (let i = 0; i < (21 + modifier); i++) {
        let x;
        do {
            x = false;
            let rand = Math.floor(Math.random() * 7);
            if (list[rand] < 10) {
                list[rand]++;
            } else {
                x = true;
            }
        } while (x);
    }
    console.log("S:" + list[0] + " P:" + list[1] + " E:" + list[2] + " C:" + list[3] + " I:" + list[4] + " A:" + list[5] + " L:" + list[6] + " - With modifier " + modifier);
}