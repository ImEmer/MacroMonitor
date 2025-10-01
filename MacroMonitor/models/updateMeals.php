<?php
session_start();
include('../database/connections/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $mealId = intval($_POST['meal_id']);
    $userId = $_SESSION['user_id'];

    $food_name = $_POST['food_name'];
    $serving_size = $_POST['serving_size'];
    $protein = $_POST['protein'];
    $carbs = $_POST['carbs'];
    $fats = $_POST['fats'];
    $calories = $_POST['calories'];

    $stmt = $conn->prepare("UPDATE meals 
        SET food_name=?, serving_size=?, protein=?, carbs=?, fats=?, calories=? 
        WHERE meal_id=? AND uid=?");
    $stmt->bind_param("ssddddii", $food_name, $serving_size, $protein, $carbs, $fats, $calories, $mealId, $userId);
    $stmt->execute();
    $stmt->close();

    header("Location: ../pages/logMeals.php");
    exit();
} else {
    echo "Unauthorized request.";
}
