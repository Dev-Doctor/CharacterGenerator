<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!–– CSS LINK -->
    <link rel="stylesheet" href="css/main.css">
    <!–– JAVASCRIPT LINKS -->
    <script src="js/character_SPECIAL.js"></script>
    <script src="js/character_traits.js"></script>
    <script src="js/identity.js"></script>
    <script src="js/sample_names.js"></script>
    <title>Document</title>
</head>
    <?php
        include 'php/connect.php';
        include 'php/functions.php';

        $conn = CreateConnection();
    ?>

    <div class="first">
        <div>
            <p>Generate the S.P.E.C.I.A.L.</p>
            <button onclick="SPECIAL.Generate()">Generate</button>
        </div>
    </div>

    <div class="first">
        <div>
            <p>Generate the traits</p>
            <button onclick="TRAITS.Generate()">Generate</button>
        </div>
    </div>

    <div class="first">
        <div>
            <p>Generate Name by Race and Gender</p>
            <button onclick="IDENTITY.Generate(VALUES.names)">Generate</button>
        </div>
    </div>

<body>
    
</body>
</html>