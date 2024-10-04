<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .primary {
            background: #3BEF80;
        }

        .text-primary {
            color: #3BEF80;
        }

     
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="max-w-md w-full p-6 bg-white rounded-md shadow-md">
        <h2 class="text-3xl font-bold text-center mb-6" style="color: #61BCE9;">Sign Up</h2>
        <form id="signupForm">
            <div class="mb-4">
                <label for="inputName" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" id="inputName"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    placeholder="Enter your full name" required>
                <span class="text-red-500 text-sm" id="inputNameError"></span>
            </div>
            <div class="mb-4">
                <label for="inputPhoneNumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" id="inputPhoneNumber"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    placeholder="Enter your phone number" required pattern="\d{10}">
                <span class="text-red-500 text-sm" id="inputPhoneNumberError"></span>
            </div>
            <div class="mb-4">
                <label for="inputEmail" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" id="inputEmail"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    placeholder="Enter your college email" required>
                <span class="text-red-500 text-sm" id="inputEmailError"></span>
            </div>
            <div class="mb-4 relative">
                <label for="inputPassword" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="inputPassword"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                    placeholder="Create a password" required minlength="6">
                <!-- Password toggle button -->
                <button type="button" class="absolute right-3 top-3 text-gray-600 hover:text-gray-900"
                    id="togglePassword" style="
    margin-top: 21px;
">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.93 7.07a9 9 0 0112.74 0M1 1l22 22" />
                    </svg>
                </button>
                <span class="text-red-500 text-sm" id="inputPasswordError"></span>
            </div>
            <button type="submit"
                class="w-full py-2 px-4 rounded-md primary text-white font-bold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Sign Up
            </button>

            <div class="mt-4 text-center">
                <span class="text-gray-600">Already have an account?</span>
                <a href="index.php" class="text-sm text-primary hover:text-indigo-900 font-bold">Sign in</a>
            </div>
        </form>
    </div>

    <!-- Link to the external JavaScript file -->
    
    <script src="js/signup.js"></script>
</body>

</html>
