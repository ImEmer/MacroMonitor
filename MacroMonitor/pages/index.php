<?php
    session_start();
    include('../database/connections/conn.php');
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

<body class="bg-gray-50 pt-32"> 

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

    <!-- =================== HERO SECTION =================== -->
    <section class="text-center py-20 mt-12">
        <h1 class="text-7xl font-bold leading tight mb-8">
            Track your <span class="text-green-600">nutrition</span>, live healthier
        </h1>
        <h2 class="mt-4 text-xl text-gray-600 max-w-4xl mx-auto">
            Stay on top of your nutrition effortlessly. Log meals, track macros, 
            and reach your goals with our easy-to-use tracker.
        </h2>
        <a href="logMeals.php"
           class="mt-8 inline-block bg-green-500 text-white text-xl font-medium px-6 py-3 rounded-lg shadow hover:bg-green-600 transition">
           Start Tracking Today <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </section>

    <!-- =================== FEATURES SECTION =================== -->
    <section class="py-16 mt-24">
        <div class="max-w-6xl mx-auto px-6">

            <div class="flex justify-center items-center">
                <h1 class="text-3xl mb-20 font-bold mt-10">Stay on Track with These Features</h1>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 text-center md:text-left">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center md:items-start" data-aos="fade-down">
                    <i class="fas fa-bullseye text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-bold mb-2">Powerful Daily Tracking</h3>
                    <p class="text-gray-600">Track your daily macros and calories with ease.</p>
                </div>
                <!-- Feature 2 -->
                <div class="flex flex-col items-center md:items-start" data-aos="fade-down">
                    <i class="fas fa-utensils text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-bold mb-2">Meal Logging Made Simple</h3>
                    <p class="text-gray-600">Quickly log your meals and snacks with a clean interface.</p>
                </div>
                <!-- Feature 3 -->
                <div class="flex flex-col items-center md:items-start" data-aos="fade-down">
                    <i class="fas fa-chart-line text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-bold mb-2">Progress Insights</h3>
                    <p class="text-gray-600">Visualize your progress with graphs and reports on macros over time.</p>
                </div>
                <!-- Feature 4 -->
                <div class="flex flex-col items-center md:items-start" data-aos="fade-down">
                    <i class="fas fa-sliders-h text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-bold mb-2">Custom Goals</h3>
                    <p class="text-gray-600">Set personalized nutrition goals for protein, carbs, fats, and calories.</p>
                </div>
                <!-- Feature 5 -->
                <div class="flex flex-col items-center md:items-start" data-aos="fade-down">
                    <i class="fas fa-history text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-bold mb-2">History of Meals</h3>
                    <p class="text-gray-600">Review your past logged meals to track patterns and habits.</p>
                </div>
                <!-- Feature 6 -->
                <div class="flex flex-col items-center md:items-start" data-aos="fade-down">
                    <i class="fas fa-clipboard-list text-green-600 text-4xl mb-4"></i>
                    <h3 class="text-lg font-bold mb-2">Daily Summary Dashboard</h3>
                    <p class="text-gray-600">See a clear breakdown of today’s macros and calories at a glance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =================== STEPS SECTION =================== -->
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-12">
                Hit your <span class="text-green-600">nutrition goals</span> in 1-2-3
            </h2>

            <div class="space-y-20">
                <!-- Step 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-12">
                    <img src="../assets/img/createacc.png" alt="Create Account" class="rounded-xl shadow-lg" data-aos="fade-right">
                    <div class="text-left">
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-2xl font-bold mb-4">1</div>
                        <h3 class="text-2xl font-bold mb-4">Create your account</h3>
                        <p class="text-gray-600 text-lg">Sign up in seconds and set up your profile with your personal details.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-12 md:flex-row-reverse">
                    <div class="order-2 md:order-1 text-left">
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-2xl font-bold mb-4">2</div>
                        <h3 class="text-2xl font-bold mb-4">Log your meals</h3>
                        <p class="text-gray-600 text-lg">Easily enter what you eat and let MacroMonitor calculate your macros.</p>
                    </div>
                    <img src="../assets/img/logmeals.png" alt="Log Meals" class="order-1 md:order-2 rounded-xl shadow-lg" data-aos="fade-left">
                </div>

                <!-- Step 3 -->
                <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-12">
                    <img src="../assets/img/progress.png" alt="Review Insights" class="rounded-xl shadow-lg" data-aos="fade-right">
                    <div class="text-left">
                        <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 text-green-600 text-2xl font-bold mb-4">3</div>
                        <h3 class="text-2xl font-bold mb-4">Review insights</h3>
                        <p class="text-gray-600 text-lg">Check progress summaries and adjust your nutrition to hit your goals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- =================== FAQ SECTION =================== -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">
                Frequently Asked <span class="text-green-600">Questions</span>
            </h2>

            <div class="space-y-4">

                <!-- FAQ Item 1 -->
                <div class="border rounded-lg overflow-hidden" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-4 text-left font-semibold faq-toggle">
                        <span><i class="fas fa-question-circle text-green-600 mr-2"></i> What is Macromonitor?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer hidden px-4 pb-4 text-gray-600">
                        Macromonitor is an easy-to-use web application designed to help individuals take control of their nutrition. 
                        With this tool, you can log your meals, keep track of calories, and monitor the balance of macronutrients—protein, 
                        carbohydrates, and fats—throughout your day. Whether you’re trying to lose weight, gain muscle, or simply maintain 
                        a healthier lifestyle, Macromonitor provides a simple yet powerful way to see what you’re eating and how it 
                        contributes to your goals. By turning your daily food intake into clear and organized data, the app makes it easier 
                        to understand your eating habits and make smarter choices.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border rounded-lg overflow-hidden" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-4 text-left font-semibold faq-toggle">
                        <span><i class="fas fa-question-circle text-green-600 mr-2"></i> How do I create an account on Macromonitor?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer hidden px-4 pb-4 text-gray-600">
                        Creating an account on Macromonitor is quick and beginner-friendly. All you need to do is click the 
                        <strong>“Sign Up”</strong> button on the homepage, then provide your basic information such as your name, 
                        email, and password. Once your account is created, you’ll immediately gain access to the dashboard where you 
                        can start logging your meals and setting your nutrition goals. The process only takes a couple of minutes, and 
                        after signing up, your data will be securely stored, so you can always return and pick up right where you left 
                        off—whether on desktop or mobile.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border rounded-lg overflow-hidden" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-4 text-left font-semibold faq-toggle">
                        <span><i class="fas fa-question-circle text-green-600 mr-2"></i> Can I track my daily calorie intake?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer hidden px-4 pb-4 text-gray-600">
                        Yes! One of the main features of Macromonitor is its built-in calorie tracking system. Every time you log a meal, 
                        the app automatically calculates the total calories for that food and adds it to your daily progress. This helps you 
                        keep a clear overview of how much energy you are consuming each day. Beyond just numbers, Macromonitor also compares 
                        your calorie intake against your personal targets, showing whether you are under, meeting, or exceeding your daily goal. 
                        This makes it much easier to stay consistent and avoid overeating or undereating.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border rounded-lg overflow-hidden" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-4 text-left font-semibold faq-toggle">
                        <span><i class="fas fa-question-circle text-green-600 mr-2"></i> Does Macromonitor give nutrition insights?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer hidden px-4 pb-4 text-gray-600">
                        Absolutely. Macromonitor goes beyond just logging meals—it provides useful nutrition insights that help you 
                        understand your eating patterns. The app organizes your data into easy-to-read charts and reports, showing how 
                        your meals are distributed between proteins, carbohydrates, and fats. It can highlight if you are consistently 
                        missing certain nutrients or if you are consuming too much of one macronutrient compared to the others. With these 
                        insights, you can adjust your diet more effectively, whether your goal is weight loss, muscle growth, or simply 
                        eating a more balanced diet.
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="border rounded-lg overflow-hidden" data-aos="fade-up">
                    <button class="w-full flex justify-between items-center p-4 text-left font-semibold faq-toggle">
                        <span><i class="fas fa-question-circle text-green-600 mr-2"></i> Is Macromonitor free to use?</span>
                        <i class="fas fa-chevron-down transition-transform"></i>
                    </button>
                    <div class="faq-answer hidden px-4 pb-4 text-gray-600">
                        Yes, Macromonitor is completely free to use for its core features, which include meal logging, calorie tracking, 
                        and basic nutrition reports. This means anyone can start monitoring their nutrition without worrying about costs. 
                        In the future, we may introduce premium features for users who want more advanced tools such as detailed progress 
                        analytics, custom meal suggestions, or enhanced data export options. But even with just the free version, you’ll 
                        have everything you need to start building healthier eating habits.
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =================== SCRIPT =================== -->
    <script src="../controllers/homecontroll.js"></script>

    <!-- =================== FOOTER =================== -->
    <footer class="bg-gray-900 text-gray-300 py-10 mt-20">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Footer Column 1: Brand Info -->
            <div>
                <h2 class="text-2xl font-bold text-white mb-4">MacroMonitor</h2>
                <p class="text-gray-400 text-sm">
                    Helping you stay on track with your nutrition goals. Track, log, and achieve with ease.
                </p>
            </div>

            <!-- Footer Column 2: Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-green-500">Features</a></li>
                    <li><a href="#" class="hover:text-green-500">Log Meals</a></li>
                    <li><a href="#" class="hover:text-green-500">Progress</a></li>
                    <li><a href="#" class="hover:text-green-500">Sign Up</a></li>
                </ul>
            </div>

            <!-- Footer Column 3: Contact -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Contact</h3>
                <p class="text-gray-400 text-sm mb-2">Got questions? Reach us at:</p>
                <p class="text-gray-300 font-semibold">support@macromonitor.com</p>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-green-500"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-500"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-500"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

        </div>

        <!-- Copyright -->
        <div class="text-center text-gray-500 text-sm mt-10 border-t border-gray-700 pt-6">
            © 2025 MacroMonitor. All rights reserved.
        </div>
    </footer>
</body>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, 
    once: false
  });
</script>

</html>
