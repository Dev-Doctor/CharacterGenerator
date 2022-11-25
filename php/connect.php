<?php
require "LoadEnv.php";
(new LoadEnv(__DIR__ . '/.env'))->load();
/**
 * @author DevDoctor
 */

/**
 * Crea la connessione al database
 * @return {Number} $conn L'oggetto della connessione al database
 */
function CreateConnection() {
    
    $servername = getenv('SERVER'); //locahost
    $username = getenv('USER');  //root
    $password = getenv('PASSWORD');
    $db_name = getenv('DATABASE_NAME'); //characters_generator
    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

/**
 * Chiude la connessione con il database
 */
function CloseConnection($conn) {
    $conn = mysqli_close($conn);
    echo "Connection Closed!";
}
