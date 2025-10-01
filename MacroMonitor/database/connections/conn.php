<?php
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $database = 'macromonitor';

    $conn = new mysqli($host, $username, $pass, $database);

    if($conn -> connect_error){
        echo $conn->connect_error;
    }

    $querydefine = 'SELECT * FROM user';
    $sqldefine= mysqli_query($conn, $querydefine);
?>