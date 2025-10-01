<?php
session_start();
include('../database/connections/conn.php');

if (!isset($_SESSION['user_id'])) {
    die("Login required.");
}

if (isset($_GET['id'])) {
    $mealId = intval($_GET['id']);
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM meals WHERE meal_id = ? AND uid = ?");
    $stmt->bind_param("ii", $mealId, $userId); 
    $stmt->execute();
    $result = $stmt->get_result();
    $meal = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <!-- =================== GOOGLE FONTS =================== -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <!-- =================== CUSTOM FONTS STYLE =================== -->
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }
    h1, h2, h3, .heading {
        font-family: 'Poppins', sans-serif;
    }
    </style>

    <!-- =================== PAGE TITLE & FAVICON =================== -->
    <title>MacroMonitor | Track Your Nutrition & Goals</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon_io/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon_io/android-chrome-192x192.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- =================== ICONS & TAILWIND CSS =================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- =================== AOS CSS =================== -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="p-10 bg-gray-50">

<!-- =================== NAVIGATION BAR =================== -->
    <div class="flex items-center flex-wrap justify-between px-10 bg-white fixed top-0 left-0 w-full z-50">
        <a href="index.php" class="flex items-center">
            <img src="../assets/img/main_logo.png" class="w-20 h-20 md:w-28 md:h-28" alt="Logo">
            <h1 class="text-4xl font-bold text-green-600 -ml-3">MacroMonitor</h1>
        </a>

        <!-- Nav Links -->
        <ul class="flex flex-col md:flex-row text-lg gap-4 md:gap-6 mt-4 md:mt-0 mr-0 md:mr-5 w-full md:w-auto text-center md:text-right">
            <li><a href="" class="hover:text-green-600">Features</a></li>
            <li><a href="logMeals.php" class="hover:text-green-600">Log Meals</a></li>
            <li><a href="" class="hover:text-green-600">Progress</a></li>

            <?php if(isset($_SESSION['user_name'])): ?>
                <!-- Show user's name if logged in -->
                <li>
                    <span class="font-semibold text-green-600">
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </span>
                </li>
                <li>
                    <a href="../auth/logout.php" class=" py-2">
                            <i class="fas fa-arrow-right-from-bracket ml-2 hover:text-red-600 transition-colors duration-300"></i>
                    </a>
                </li>
            <?php else: ?>
                <!-- Show Sign Up -->
                <li><a href="loginUI.php" class="hover:text-green-600">Login</a></li>
                <li>
                    <a href="signupUI.php" class="rounded-3xl bg-gray-200 px-5 py-2 hover:bg-green-600 hover:text-white transition">
                        Sign Up
                    </a>
                </li>
            <?php endif; ?>
        </ul>

    </div>


  <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow mt-24">
    <h2 class="text-2xl font-bold mb-6">Edit Meal</h2>
    <form action="../models/updateMeals.php" method="POST" class="space-y-6">
        <input type="hidden" name="meal_id" value="<?php echo $meal['meal_id']; ?>">

        <!-- Food Name + Serving Size in one row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="food_name" class="block text-sm font-medium text-gray-700">Food Name</label>
                <input type="text" id="food_name" name="food_name" 
                       value="<?php echo htmlspecialchars($meal['food_name']); ?>" 
                       class="w-full p-2 border rounded mt-1" required>
            </div>
            <div>
                <label for="serving_size" class="block text-sm font-medium text-gray-700">Serving Size</label>
                <input type="text" id="serving_size" name="serving_size" 
                       value="<?php echo htmlspecialchars($meal['serving_size']); ?>" 
                       class="w-full p-2 border rounded mt-1" required>
            </div>
        </div>

        <!-- Protein -->
        <div>
            <label for="protein" class="block text-sm font-medium text-gray-700">Protein (g)</label>
            <input type="number" step="0.01" id="protein" name="protein" 
                   value="<?php echo $meal['protein']; ?>" 
                   class="w-full p-2 border rounded mt-1">
        </div>

        <!-- Carbs -->
        <div>
            <label for="carbs" class="block text-sm font-medium text-gray-700">Carbs (g)</label>
            <input type="number" step="0.01" id="carbs" name="carbs" 
                   value="<?php echo $meal['carbs']; ?>" 
                   class="w-full p-2 border rounded mt-1">
        </div>

        <!-- Fats -->
        <div>
            <label for="fats" class="block text-sm font-medium text-gray-700">Fats (g)</label>
            <input type="number" step="0.01" id="fats" name="fats" 
                   value="<?php echo $meal['fats']; ?>" 
                   class="w-full p-2 border rounded mt-1">
        </div>

        <!-- Calories -->
        <div>
            <label for="calories" class="block text-sm font-medium text-gray-700">Calories</label>
            <input type="number" step="0.01" id="calories" name="calories" 
                   value="<?php echo $meal['calories']; ?>" 
                   class="w-full p-2 border rounded mt-1">
        </div>

        <!-- Submit -->
        <button type="submit" 
                class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
            Update Meal
        </button>
    </form>
</div>


</body>
</html>
