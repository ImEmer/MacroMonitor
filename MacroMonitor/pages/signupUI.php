<?php
    session_start();
    include('../database/connections/conn.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your account for free</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }
    h1, h2, h3, .heading {
        font-family: 'Poppins', sans-serif;
    }
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon_io/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon_io/android-chrome-192x192.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-lg">

        <a href="index.php" class="flex justify-center">
        <img src="../assets/img/main_logo.png" class="w-20 h-20 md:w-28 md:h-28" alt="">
        </a>

        <h1 class="text-2xl font-bold mb-6 text-center">Sign up for MacroMonitor</h1>

        <form action="../auth/signup_handler.php" method="POST" class="space-y-4">

        <div class="flex items-center gap-4">
            <label for="firstname" class="w-32 font-medium">First Name</label>
            <input type="text" id="firstname" name="firstname"
                class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex items-center gap-4">
            <label for="email" class="w-32 font-medium">Email</label>
            <input type="email" id="email" name="email"
                class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex items-center gap-4">
            <label for="password" class="w-32 font-medium">Password</label>
            <input type="password" id="password" name="password"
                class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <h2 class="text-xl font-semibold mt-12 mb-2">Profile Details</h2>

        <div class="flex items-center gap-4">
            <label for="sex" class="w-32 font-medium">Sex</label>
            <select id="sex" name="sex"
                    class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
        </div>

        <div class="flex items-center gap-4">
            <label for="height" class="w-32 font-medium">Height (cm)</label>
            <input type="number" id="height" name="height"
                class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="flex items-center gap-4">
            <label for="weight" class="w-32 font-medium">Weight (kg)</label>
            <input type="number" id="weight" name="weight"
                class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <button name="submit"
                type="submit"
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
            Sign Up
        </button>
        </form>
    </div>
</div>



</body>

</html>