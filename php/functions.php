<?php

// ATTENZIONE LEGGERE -> questa funzione è per/in testing, la modificherò, quindi non usatela nei moduli JS per il generatore come se fosse finita 
// SERVE -> esegue la query all'interno della variabile $myQuery e ritorna l'oggetto che contiene i dati recuperati 
function GetData($conn) {
    // TEST QUERY DON'T USE THIS ONE -> 
    $myQuery = "SELECT names.ID, names.name, names.gender, names.race, races.name FROM names INNER JOIN races ON names.race = races.id ORDER BY RAND() LIMIT 1";
    // $myQuery = "SELECT * FROM names ORDER BY RAND() LIMIT 1";
    return $conn->query($myQuery);
}

function GetTraits($conn, $race) {
    $myQuery = "SELECT races.ID, traits.BaseHeight, traits.HeightModifier, traits.BaseWeight, traits.WeightModifier, traits.size FROM races INNER JOIN traits ON races.ID=traits.ID WHERE races.ID = " . $race;
    $that = $conn->query($myQuery);
    if ($that->num_rows > 0) {
        // output data of each row
        while ($row = $that->fetch_assoc()) {
            echo "id: " . $row["BaseHeight"] . "<br>";
        }
    } else {
        echo "0 results";
    }
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

function GetRace($conn, $name) {
	if ($name == '') {
		$myQuery = "SELECT * FROM `races` ORDER BY RAND() LIMIT 1;";
	} else {
		$myQuery = "SELECT * FROM `races` WHERE races.name = '$name'";
	}
    $that = $conn->query($myQuery);
    if ($that->num_rows > 0) {
        // output data of each row
        while ($row = $that->fetch_assoc()) {
            echo "id: " . $row["ID"] . " name: " . $row["Name"] . " maxAge: " . $row["MaxAge"] . " maxWeight: " . $row["MaxWeight"] . " maxHeight: " . $row["MaxHeight"] ."<br>";
        }
    } else {
        echo "0 results";
    }
}

/* -------- QUERIES -------- */
// get all racial traits with race => SELECT * FROM `racial_traits` WHERE race = 1
// get all traits with race => SELECT races.ID, traits.BaseHeight, traits.HeightModifier, traits.BaseWeight, traits.WeightModifier, traits.size FROM races INNER JOIN traits ON races.ID=traits.ID WHERE races.ID = 1
// get a random race => SELECT * FROM races ORDER BY RAND() LIMIT 1