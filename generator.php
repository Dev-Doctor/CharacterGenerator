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
    <script src="js/character_traits.js"></script>
    <script src="js/sample_names.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Document</title>
</head>

<body>

    <nav class="header">
        <div class="header-content-site">
            <a href="index.html"><img class="header-icon" src="img/icon_dark.png"></a>
            <div class="header-name centered">Character Generator</div>
        </div>

        <div class="header-content-menu">
            <img class="header-menu" src="img/white_menu.png" onclick="openNav()">
        </div>
    </nav>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>

    <div class="main" id = "generated">
        <div class="main-lore justified">
            <p>

                <?php
                include 'php/connect.php';
                include 'php/character.php';

                $conn = CreateConnection();

                //GetTraits($conn, 1);
                $character = new Character($conn);
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
            </p>
        </div>


    </div>


</body>

</html>