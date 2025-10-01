<?php
    session_start();
    include('../database/connections/conn.php');

    //log in muna bago lumabas si log meals
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../pages/loginUI.php"); 
        exit();
    }

    $userId = $_SESSION['user_id'];
    $today = date("Y-m-d");

    // Query for today's totals
    $stmt = $conn->prepare("
        SELECT 
            COALESCE(SUM(protein),0) AS total_protein,
            COALESCE(SUM(carbs),0) AS total_carbs,
            COALESCE(SUM(fats),0) AS total_fats,
            COALESCE(SUM(calories),0) AS total_calories
        FROM meals 
        WHERE uid = ? AND DATE(created_at) = ?
    ");
    $stmt->bind_param("is", $userId, $today);
    $stmt->execute();
    $result = $stmt->get_result();
    $summary = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <title>MacroMonitor | Daily log your meals</title>
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
<body class="bg-gray-50 pt-32">

    <div class="flex items-center flex-wrap justify-between px-10 bg-white fixed top-0 left-0 w-full z-50">
        <a href="index.php" class="flex items-center">
            <img src="../assets/img/main_logo.png" class="w-20 h-20 md:w-28 md:h-28" alt="Logo">
            <h1 class="text-4xl font-bold text-green-600 -ml-3">MacroMonitor</h1>
        </a>

        <!-- Nav Links -->
        <ul class="flex flex-col md:flex-row text-lg gap-4 md:gap-6 mt-4 md:mt-0 mr-0 md:mr-5 w-full md:w-auto text-center md:text-right">
            <li><a href="" class="hover:text-green-600">Features</a></li>
            <li><a href="" class="hover:text-green-600">Log Meals</a></li>
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

        <!-- Container -->
    <div class="max-w-6xl mx-auto px-14 py-6">
        
        <!-- Header -->
        <div class="mb-5">
        <h1 class="text-3xl font-bold mb-2">Meal Logger</h1>
        <p class="text-gray-500">Track your daily nutrition and monitor your progress towards your goals.</p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
        <!-- Add Meal -->
        <div class="md:col-span-2 bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold flex items-center gap-2 text-green-600 mb-2">
            <i class="fas fa-plus"></i> Add New Meal
            </h2>
            <p class="text-gray-500 text-sm mb-4">Log meals to monitor your daily intake.</p>
            

        <form class="grid grid-cols-2 gap-4" method="post" action="../models/tblmeals.php">
            <!-- Food Name & Serving Size in same row -->
            <div class="flex flex-col">
                <label for="food_name" class="font-medium text-gray-700 mb-1">Food Name</label>
                <input type="text" name="food_name" placeholder="e.g., Adobong Manok" 
                    class="border p-2 rounded w-full" />
            </div>

            <div class="flex flex-col">
                <label for="serving_size" class="font-medium text-gray-700 mb-1">Serving Size</label>
                <input type="text" name="serving_size" placeholder="e.g., 100g, 1 cup" 
                    class="border p-2 rounded w-full" />
            </div>

            <!-- Protein -->
            <div class="flex items-center gap-2">
                <span class="text-pink-500"><i class="fas fa-circle"></i></span>
                <input type="number" name="protein" placeholder="Protein (g)" class="border p-2 rounded w-full" />
            </div>

            <!-- Carbs -->
            <div class="flex items-center gap-2">
                <span class="text-yellow-500"><i class="fas fa-circle"></i></span>
                <input type="number" name="carbs" placeholder="Carbs (g)" class="border p-2 rounded w-full" />
            </div>

            <!-- Fats -->
            <div class="flex items-center gap-2">
                <span class="text-purple-500"><i class="fas fa-circle"></i></span>
                <input type="number" name="fats" placeholder="Fats (g)" class="border p-2 rounded w-full" />
            </div>

            <!-- Calories -->
            <div class="flex items-center gap-2">
                <span class="text-blue-500"><i class="fas fa-circle"></i></span>
                <input type="number" name="calories" placeholder="Calories" class="border p-2 rounded w-full" />
            </div>

            <!-- Submit Button -->
            <div class="col-span-2">
                <button name="add_meal" class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded">
                    <i class="fas fa-plus-circle mr-2"></i> Add Meal
                </button>
            </div>
        </form>


        </div>

        <!-- Daily Summary -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-xl font-bold flex items-center gap-2 mb-2">
            <i class="fas fa-chart-line text-green-600"></i> Daily Summary
            </h2>
            <p class="text-gray-500 text-sm mb-4">Your progress towards daily nutrition goals</p>

            <!-- Summary Items -->
            <div class="space-y-4">
    <div>
        <p class="flex justify-between text-sm">
            <span class="flex items-center gap-2 text-pink-500">
                <i class="fas fa-circle"></i> Protein
            </span> 
            <span><?php echo $summary['total_protein']; ?>g / 150g</span>
        </p>
        <div class="w-full bg-gray-200 rounded h-2 mt-1">
            <div class="bg-pink-500 h-2 rounded" 
                 style="width: <?php echo min(100, ($summary['total_protein']/150)*100); ?>%"></div>
        </div>
    </div>

    <div>
        <p class="flex justify-between text-sm">
            <span class="flex items-center gap-2 text-yellow-500">
                <i class="fas fa-circle"></i> Carbohydrates
            </span> 
            <span><?php echo $summary['total_carbs']; ?>g / 200g</span>
        </p>
        <div class="w-full bg-gray-200 rounded h-2 mt-1">
            <div class="bg-yellow-500 h-2 rounded" 
                 style="width: <?php echo min(100, ($summary['total_carbs']/200)*100); ?>%"></div>
        </div>
    </div>

    <div>
        <p class="flex justify-between text-sm">
            <span class="flex items-center gap-2 text-purple-500">
                <i class="fas fa-circle"></i> Fats
            </span> 
            <span><?php echo $summary['total_fats']; ?>g / 70g</span>
        </p>
        <div class="w-full bg-gray-200 rounded h-2 mt-1">
            <div class="bg-purple-500 h-2 rounded" 
                 style="width: <?php echo min(100, ($summary['total_fats']/70)*100); ?>%"></div>
        </div>
    </div>

    <div>
        <p class="flex justify-between text-sm">
            <span class="flex items-center gap-2 text-blue-500">
                <i class="fas fa-circle"></i> Calories
            </span> 
            <span><?php echo $summary['total_calories']; ?> / 2000</span>
        </p>
        <div class="w-full bg-gray-200 rounded h-2 mt-1">
            <div class="bg-blue-500 h-2 rounded" 
                 style="width: <?php echo min(100, ($summary['total_calories']/2000)*100); ?>%"></div>
        </div>
    </div>
</div>

<!-- Totals -->
<div class="flex justify-around mt-6 text-center">
    <div><p class="text-pink-500 font-bold"><?php echo $summary['total_protein']; ?></p><p class="text-xs">PROTEIN (G)</p></div>
    <div><p class="text-yellow-500 font-bold"><?php echo $summary['total_carbs']; ?></p><p class="text-xs">CARBS (G)</p></div>
    <div><p class="text-purple-500 font-bold"><?php echo $summary['total_fats']; ?></p><p class="text-xs">FATS (G)</p></div>
    <div><p class="text-blue-500 font-bold"><?php echo $summary['total_calories']; ?></p><p class="text-xs">CALORIES</p></div>
</div>
        </div>
        </div>


                <!-- Today's Meals -->
            <div class="mt-10">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $userId = $_SESSION['user_id'];
                    $today = date('Y-m-d');

                    $result = mysqli_query($conn, "SELECT * FROM meals WHERE uid = '$userId' AND DATE(created_at) = '$today' ORDER BY created_at DESC");
                    $mealCount = mysqli_num_rows($result);
                ?>
                    <h2 class="text-xl font-bold mb-4">Today's Meals (<?php echo $mealCount; ?>)</h2>

                    <?php if ($mealCount > 0): ?>
                        <div class="space-y-4">
                            <?php while ($meal = mysqli_fetch_assoc($result)): ?>
                                <div class="bg-white p-4 rounded-xl shadow">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-semibold"><?php echo htmlspecialchars($meal['food_name']); ?></h3>
                                        <span class="text-sm text-gray-500">
                                            <i class="fas fa-clock mr-1"></i>
                                            <?php echo date('M d, Y h:i A', strtotime($meal['created_at'])); ?>
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars($meal['serving_size']); ?></p>
                                    <div class="flex gap-4 mt-2 text-sm text-gray-600">
                                        <span><i class="fas fa-drumstick-bite text-pink-500"></i> Protein: <?php echo $meal['protein']; ?>g</span>
                                        <span><i class="fas fa-bread-slice text-yellow-500"></i> Carbs: <?php echo $meal['carbs']; ?>g</span>
                                        <span><i class="fas fa-cheese text-purple-500"></i> Fats: <?php echo $meal['fats']; ?>g</span>
                                        <span><i class="fas fa-fire text-blue-500"></i> Calories: <?php echo $meal['calories']; ?></span>
                                    </div>

                            <div class="flex justify-end space-x-2 mt-4">
                                <!-- Edit Button -->
                                <a href="editMeals.php?id=<?php echo $meal['meal_id']; ?>" 
                                class="px-4 py-2 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600 transition">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <a href="../models/deleteMeals.php?meal_id=<?php echo $meal['meal_id']; ?>" 
                                    onclick="return confirm('Are you sure you want to delete this meal?')" 
                                    class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </a>

                            </div>

                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-white p-6 rounded-xl shadow text-center text-gray-400">
                            <i class="fas fa-utensils text-4xl mb-2"></i>
                            <p class="font-medium">No meals logged today</p>
                            <p class="text-sm">Start by adding your first meal above!</p>
                        </div>
                    <?php endif; ?>

                <?php } else { ?>
                    <h2 class="text-xl font-bold mb-4">Today's Meals</h2>
                    <div class="bg-white p-6 rounded-xl shadow text-center text-gray-400">
                        <i class="fas fa-user-lock text-4xl mb-2"></i>
                        <p class="font-medium">Please log in to view your meals</p>
                    </div>
                <?php } ?>
            </div>




    </div>



</body>
</html>