<?php
session_start();
include('../database/connections/conn.php');

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$userId = $_SESSION['user_id'];
$today = date("Y-m-d");

// SUM up all macros for today's meals
$stmt = $conn->prepare("
    SELECT 
        SUM(protein) AS total_protein,
        SUM(carbs) AS total_carbs,
        SUM(fats) AS total_fats,
        SUM(calories) AS total_calories
    FROM meals 
    WHERE uid = ? AND DATE(created_at) = ?
");
$stmt->bind_param("is", $userId, $today);
$stmt->execute();
$result = $stmt->get_result();
$summary = $result->fetch_assoc();
?>
