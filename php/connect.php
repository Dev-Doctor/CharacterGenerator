<?php

/**
 * @author DevDoctor
 */

/**
 * Crea la connessione al database
 * @return {Number} $conn L'oggetto della connessione al database
 */
function CreateConnection() {
    $servername = "localhost"; 
    $username = "root"; 
    $password = "";
    $db_name = "characters_generator";

    $conn = mysqli_connect($servername, $username, $password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connection established to database! <br>";
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
