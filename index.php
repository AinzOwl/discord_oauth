<?php
require_once 'includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Import Tailwind CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <?php if (isset($_SESSION['discord'])): ?>
        
        <!-- User is logged in, display user info -->
        <div class="mb-4">
            <h1 class="text-2xl font-bold">User Information</h1>
            <pre class="bg-white p-4 rounded shadow mt-2"><code><?php echo json_encode($_SESSION['discord'], JSON_PRETTY_PRINT); ?></code></pre>
        </div>
        <a href="logout.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Logout</a>

        <?php else: ?>

        <!-- User is not logged in, show welcome message and login button -->
        <div class="mb-4">
            <h1 class="text-2xl font-bold">Welcome to the Website</h1>
            <p class="mt-2">Please log in with Discord to continue.</p>
        </div>
        <a href="login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login with Discord</a>

        <?php endif; ?>
    </div>
</body>
</html>