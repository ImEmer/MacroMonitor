<?php
session_start();
include('../database/connections/conn.php');

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $stmt = $conn->prepare("SELECT uid, first_name, pass FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();

        if($row['pass'] === $pass){
            $_SESSION['user_id'] = $row['uid'];
            $_SESSION['user_name'] = $row['first_name'];

            header("Location: ../pages/index.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found with that email!";
    }

    $stmt->close();
}
?>
