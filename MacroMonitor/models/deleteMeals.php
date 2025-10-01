<?php
session_start();
include('../database/connections/conn.php');

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please login first.");
}

if (isset($_GET['meal_id'])) {
    $mealId = intval($_GET['meal_id']);
    $userId = $_SESSION['user_id'];

    // Only delete if meal belongs to this user
    $stmt = $conn->prepare("DELETE FROM meals WHERE meal_id = ? AND uid = ?");
    $stmt->bind_param("ii", $mealId, $userId);

    if ($stmt->execute()) {
        header("Location: ../pages/logMeals.php?msg=Meal deleted successfully");
        exit;
    } else {
        echo "Error deleting meal: " . $stmt->error;
    }
} else {
    echo "No meal specified.";
}
?>
