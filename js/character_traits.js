//     minHeight-maxHeight   skinColors              eyesColors               minAge-maxAge
const human = [[155], [190], ["white", "black"], ["brown", "green", "light blue"], [16], [99]];              //minWeight-maxWeight
const goblin = [[90], [120], ["dark red", "dark green", "dark yellow"], ["red", "orange", "yellow"], [8], [60], [18], [20]];

function Random(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function GenerateData(race) {
    var height, skin, eyes, age, weight, birth;

    age = Random(race[4], race[5]);
    height = Random(race[0], race[1]);
    if (race == human) {
        let minWeight = (height % 100) - 10, maxWeight = (height % 100) + 10;
        weight = Random(minWeight, maxWeight);
    } else {
        weight = Random(race[6], race[7]);
    }
    skin = race[2][Random(0, race[2].length - 1)];
    eyes = race[3][Random(0, race[3].length - 1)];
    birth = 2022 - age;
    console.log("age:" + age + " height:" + height + " weight:" + weight + " skin color:" + skin + " Eyes:" + eyes + " BirthDate(year):" + birth);
}

var TRAITS = {
    Generate: () => {
        let race = "human";
        switch (race) {
            case "human":
                GenerateData(human);
                break;
            case "goblin":
                GenerateData(goblin);
                break;
        }
    }
}
