<?php
session_start();
include('../database/connections/conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to MacroMonitor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
    body { font-family: 'Inter', sans-serif; }
    h1, h2, h3, .heading { font-family: 'Poppins', sans-serif; }
    </style>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon_io/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon_io/android-chrome-192x192.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-lg">

        <a href="index.php" class="flex justify-center mb-6">
            <img src="../assets/img/main_logo.png" class="w-20 h-20 md:w-28 md:h-28" alt="">
        </a>

        <h1 class="text-2xl font-bold mb-6 text-center">Login to MacroMonitor</h1>

        <form action="../auth/login_handler.php" method="POST" class="space-y-4">

            <div class="flex items-center gap-4">
                <label for="email" class="w-32 font-medium">Email</label>
                <input type="email" id="email" name="email" required
                       class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex items-center gap-4">
                <label for="password" class="w-32 font-medium">Password</label>
                <input type="password" id="password" name="password" required
                       class="flex-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button type="submit" name="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition flex items-center justify-center">
                Login <i class="fas fa-arrow-right ml-2"></i>
            </button>

        </form>

        <p class="text-center mt-4 text-gray-500">
            Don't have an account? <a href="signupUI.php" class="text-green-600 font-semibold hover:underline">Sign Up</a>
        </p>

    </div>
</div>

</body>
</html>
