<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- ICO -->
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">
</head>

<style>
    * {
        /* border: 1px solid black; */
        color: white;
    }

    body {
        background-image: url("./img/background.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<?php
include 'php/connect.php';
include 'php/character.php';

$conn = CreateConnection();
$character = null;

if (isset($_GET['race'])) {
    $character = new Character($conn);
    $character->SetSelectedRace($_GET['race']);
    $character->Generate();
}
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container bg-dark">
        <br>
        <div class="row">
            <form action="" method="GET">
                <select class="form-select" aria-label="Race Selector" name="race">
                    <option value="-1" selected>Random Race</option>
                    <?php
                    $myQuery = "SELECT ID,name FROM races";
                    $races = $conn->query($myQuery);
                    if ($races->num_rows > 0) {
                        while ($single_rc = $races->fetch_assoc()) {
                            echo '<option value="' . $single_rc["ID"] . '">' . $single_rc["name"] . '</option>';
                        }
                    }
                    ?>
                </select>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ab_scores" id="flexCheckChecked" value="D" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Determed Ability Scores
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="ab_scores" id="flexCheckDefault" value="R">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Random Ability Scores
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-primary bg-danger border-danger">Reset</button>
            </form>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="h4 pb-2 mb-4 border-bottom">
                    Identity
                </div>
                <?php
                if ($character != null) {
                    echo "<p>Name: " . $character->GetName() . "</p>";
                    echo "<p>Lastname: " . $character->GetLastname() . "</p>";
                    echo "<p>Race: " . $character->GetRaceName() . "</p>";
                    if ($character->GetMainRaceID() != null) {
                        echo "<p>Is a subrace</p>";
                    }
                    echo "<p>Age: " . $character->GetTraits()["age"] . "</p>";
                } else {
                    echo '<p>There was a problem</p>';
                }

                ?>

            </div>
            <div class="col-sm-4">
                <div class="h4 pb-2 mb-4 border-bottom">
                    Traits
                </div>
                <?php
                if ($character != null) {
                    echo "<p>Gender: " . $character->GetGender() . "</p>";
                    echo "<p>Weight: " . $character->GetTraits()["weight"] . " kg</p>";
                    echo "<p>Height: " . $character->GetTraits()["height"] . " cm</p>";
                    echo "<p>Skin Color: " . $character->GetTraits()["skin"] . "</p>";
                    echo "<p>Eyes Color: " . $character->GetTraits()["eyes"] . "</p>";
                    echo "<p>Hair Color: " . $character->GetTraits()["hair"] . "</p>";
                } else {
                    echo '<p>There was a problem</p>';
                }
                ?>
            </div>

            <div class="col-sm-4">
                <div class="h4 pb-2 mb-4 border-bottom">
                    Ability Scores
                </div>
                <?php
                echo "<p>Strenght: " . $character->GetAbilityScores()[0] . "</p>";
                echo "<p>Dexterity: " . $character->GetAbilityScores()[1] . "</p>";
                echo "<p>Constitution: " . $character->GetAbilityScores()[2] . "</p>";
                echo "<p>Intelligence: " . $character->GetAbilityScores()[3] . "</p>";
                echo "<p>Wisdom: " . $character->GetAbilityScores()[4] . "</p>";
                echo "<p>Charisma: " . $character->GetAbilityScores()[5] . "</p>";
                ?>
            </div>
        </div>
    </div>


    <!-- BOOSTRAP SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>