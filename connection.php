<?php

    include "credentials.php";
    
    // Create an object of the mysqli class enabling connection to an sql DB
    $connection = new mysqli("localhost", $user, $pw, $db);
    
    // Select all records from the scp table
    $records = $connection->prepare("select * from scp");
    
    // Run the command
    $records->execute();
    
    // Save the results into a variable
    $result = $records->get_result();

?>
