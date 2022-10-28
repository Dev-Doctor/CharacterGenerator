<?php

// ATTENZIONE LEGGERE -> questa funzione è per/in testing, la modificherò, quindi non usatela nei moduli JS per il generatore come se fosse finita 
// SERVE -> esegue la query all'interno della variabile $myQuery e ritorna l'oggetto che contiene i dati recuperati 
function GetData($conn) {
    // TEST QUERY DON'T USE THIS ONE -> $mysql = "SELECT names.ID, names.name, names.gender, names.race, races.name FROM names INNER JOIN races ON names.race = races.id ORDER BY RAND() LIMIT 1";   
    $myQuery = "SELECT * FROM names ORDER BY RAND() LIMIT 1";
    return $conn->query($myQuery);
}

// ATTENZIONE LEGGERE -> questa funzione è per/in testing, la modificherò, quindi non usatela nei moduli JS per il generatore come se fosse finita 
// SERVE -> esegue la query all'interno della variabile $myQuery e aggiunge un nome alla tabella dei nomi
function AddName($conn, $name, $gender, $race) {
    $myQuery = "INSERT INTO names (ID, name, gender, race) VALUES ('', '" . $name . "', '" . $gender . "', '" . $race . "')";

    if ($conn->query($myQuery) === TRUE) {
        echo ('console.log("New record created successfully")');
    } else {
        echo "Error: " . $myQuery . "<br>" . $conn->error;
    }
}

// ATTENZIONE LEGGERE -> questa funzione è per/in testing, la modificherò, quindi non usatela nei moduli JS per il generatore come se fosse finita 
// SERVE -> se volete eseguire le query questa è la vostra migliore opzione, anche se non è 100% sicuro che non la modifico
function ExecuteQuery($conn, $query) {
    return $conn->query($query);
}
