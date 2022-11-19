<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ICO -->
    <link rel="icon" href="">
    <!-- CSS LINK -->
    <link rel="stylesheet" href="css/main.css">
    <!-- JAVASCRIPT LINKS -->
    <script src="js/ability_scores.js"></script>
    <script src="js/character_traits.js"></script>
    <script src="js/sample_names.js"></script>
    <script src="js/character.js"></script>
    <title>Document</title>
</head>
    <?php
        include 'php/connect.php';
        include 'php/functions.php';
        include 'php/character.php';

        $conn = CreateConnection();

        //GetTraits($conn, 1);
        $character = new Character();
        $character->Generate();
    ?>

    <div class="first">
        <div>
            <p>Generate the Ability Scores</p>
            <button onclick="alert('not working for now')">Generate With Determed</button>
            <button onclick="alert('not working for now')">Generate With 4d6</button>
        </div>
    </div>

    <div class="first">
        <div>
            <p>Generate the traits</p>
            <button onclick="TRAITS.Generate()">Generate</button>
        </div>
    </div>

    <a href="index.html"><p>Home</p></a>
<body>
    
</body>
</html>