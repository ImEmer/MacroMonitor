<?php
session_start();
include('../database/connections/conn.php');

if(isset($_POST['submit'])){
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Insert user
    $insertUser = "INSERT INTO user (first_name, email, pass) VALUES ('$fname', '$email', '$pass')";
    $queryInsert = mysqli_query($conn, $insertUser);

    if($queryInsert){
        $uid = mysqli_insert_id($conn);  

        // Set session AFTER insertion
        $_SESSION['user_id'] = $uid;
        $_SESSION['user_name'] = $fname;

        // Insert profile
        $sex = mysqli_real_escape_string($conn, $_POST['sex']);
        $height = mysqli_real_escape_string($conn, $_POST['height']);
        $weight = mysqli_real_escape_string($conn, $_POST['weight']);

        $insertProfile = "INSERT INTO profiles (uid, sex, height, weightt) 
                            VALUES ('$uid', '$sex', '$height', '$weight')";
        $queryProfile = mysqli_query($conn, $insertProfile);

        if($queryProfile){
            header("Location: ../pages/index.php");
            exit();
        } else {
            echo "Profile insert error: " . mysqli_error($conn);
        }

    } else {
        echo "User insert error: " . mysqli_error($conn);
    }
}
?>
