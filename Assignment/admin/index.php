<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Replace with Tailwind CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .primary {
            background: #3BEF80;
        }

        .text-primary {
            color: #3BEF80;
        }

        /* Modal Background */
        .modal-bg {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="bg-gray-300 flex items-center justify-center h-screen">
    <div class="max-w-md w-full p-6 bg-white rounded-md shadow-md bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6 mt-2" style="color: #61BCE9;">LOGIN</h2>
        <form class="">
            <div class="mb-4">
                <label for="inputEmail" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" id="inputEmail"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    placeholder="Enter email" required autofocus>
            </div>
            <div class="mb-1">
                <label for="inputPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="inputPassword"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    placeholder="Password" required>
            </div>
            <div class="flex justify-start mb-3">
                <div class="mt-1 text-center">
                    <a href="#" id="forgot-password-link" class="text-sm text-gray-600 hover:text-gray-900">Forgot your password?</a>
                </div>
            </div>
            <div id="error-message" class="hidden text-red-500 text-sm mb-4"></div>
            <button type="submit"
                class="w-full text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 primary font-bold">Sign
                in</button>

            <div class="mt-4 text-center">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="signup.php" class="text-sm text-primary hover:text-indigo-900 font-bold ">Sign up</a>
            </div>
        </form>
    </div>

  <!-- Forgot Password Modal -->
<div id="forgot-password-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-bg">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <h3 class="text-lg text-center  font-semibold mb-4">Forgot Password</h3>
        <p class="mb-4"></p>

        <!-- Form inputs -->
        <div id="forgot-password-form">
            <input type="email" id="forgot-email"
                class="w-full px-3 py-2 mb-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                placeholder="Email address" required>
            <input type="text" id="forgot-phone"
                class="w-full px-3 py-2 mb-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                placeholder="Phone number" required>
            <div id="reset-error-message" class="hidden text-red-500 text-sm mb-4"></div>
            <div class="flex justify-end">
                <button id="cancel-modal" class="mr-2 py-2 px-4 bg-gray-300 rounded-lg">Cancel</button>
                <button id="submit-modal" class="py-2 px-4 bg-green-500 text-white rounded-lg">Submit</button>
            </div>
        </div>

        <!-- Loading animation (hidden initially) -->
        <div id="loading-spinner" class="hidden flex justify-center items-center">
            <i class="fas fa-spinner fa-spin text-gray-500 text-2xl"></i>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/login.js"></script> <!-- Include your custom JavaScript file -->
</body>

</html>
