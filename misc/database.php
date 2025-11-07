<?php
    $db_server = "localhost";
    $db_user = "root";
    
    $db_pass = 'maryanniniego'; //iniego
    $db_name = 'vivace_db'; //iniego
    $conn = "";

    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    } catch (mysqli_sql_exception) {
        echo "Database is offline! (MariaDB) <br>";
        echo "Current user: $db_user";
}
?>
