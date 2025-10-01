<?php 
session_start();
include('../database/connections/conn.php');

if (isset($_POST['add_meal'])) {
    // Get form values
    $foodName    = mysqli_real_escape_string($conn, $_POST['food_name']);
    $servingSize = mysqli_real_escape_string($conn, $_POST['serving_size']);
    $protein     = (int) $_POST['protein'];
    $carbs       = (int) $_POST['carbs'];
    $fats        = (int) $_POST['fats'];
    $calories    = (int) $_POST['calories'];

    // Get logged-in user ID from session
    if (isset($_SESSION['user_id'])) {  
        $userId = $_SESSION['user_id'];

        $addMeal = "INSERT INTO meals(uid, food_name, serving_size, protein, carbs, fats, calories)
                    VALUES ('$userId', '$foodName', '$servingSize', '$protein', '$carbs', '$fats', '$calories')";
        $queryAddMeals = mysqli_query($conn, $addMeal);

        if ($queryAddMeals) {
            echo "<script>alert('Meal added successfully!');</script>";
            header("Location: ../pages/logMeals.php");
        } else {
            echo "<script>alert('Error adding meal.');</script>";
        }
    } else {
        echo "<script>alert('You must be logged in to add meals.');</script>";
    }
}
?>
