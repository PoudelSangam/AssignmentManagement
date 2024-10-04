<?php include_once 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="https://niranjanbhatta.com.np/assets/smalllogo-5gRCzB8E.svg">
    <title> Super admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .sidebar {
            transition: transform 0.3s ease-out;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        /* Mobile view adjustments */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .navbar{
                display:none;
            }
        }
    </style>
     <!-- Include TinyMCE from CDN -->
    <script src="https://cdn.tiny.cloud/1/yc6te9f2htv9h0witspu6qol6lt4pp2ehp6qorn7yrafgxw2/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="bg-gray-100">
    <header>
        <nav class="block md:hidden bg-gray-800 p-2" id="navbar">
            <div class="max-w-7xl mx-auto px-4 py-3">
                <div class=" flex justify-between items-center">
                    <!-- Logo -->
                    <a href="#" class="flex items-center">
                        <img src="https://poudelsangam.com.np/logo.png" id="profile-picture" alt="Profile Picture" class="rounded-full h-8 w-8 mr-2">
                        <span class="text-lg font-semibold"><?php echo 'admin'; ?></span>
                    </a>
                    <!-- Mobile Menu Button -->
                    <button class="text-gray-400 focus:outline-none md:hidden" id="mobile-menu-button">
                        <svg xmlns="http://www.w3.org/2000/svg" id="menu-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar (for both mobile and desktop) -->
    <div id="mySidebar" class="sidebar fixed top-0 left-0 w-64 h-screen bg-gray-800 text-white transform -translate-x-full md:translate-x-0 md:visible transition-transform duration-500 md:block z-50">
        <div class="px-4 py-6">
            <div class="text-center">
                <img src="https://poudelsangam.com.np/logo.png" alt="Profile Picture" class="rounded-full h-20 w-20 mx-auto mb-2">
                <h5 class="text-xl font-bold"><?php echo 'Admin'; ?></h5>
            </div>
        </div>
        <nav class="mt-6">
            <ul>
                <li><a href="https://poudelsangam.com.np/Assignment/superAdmin/show_user_data.php" class="block py-2 px-4 hover:bg-gray-700">user</a></li>
                <li><a href="https://poudelsangam.com.np/Assignment/superAdmin/dashboard.php" class="block py-2 px-4 hover:bg-gray-700">dashboard</a></li>
                 <li><a href="https://poudelsangam.com.np/Assignment/admin/add_note/" class="block py-2 px-4 hover:bg-gray-700">Add Notes</a></li>
                 <li><a href="https://poudelsangam.com.np/Assignment/admin/add_new_photo_to_pdf/" class="block py-2 px-4 hover:bg-gray-700">AddQuestion</a></li>
            
               
                <li><a href="https://poudelsangam.com.np/Assignment/superAdmin/logout.php" class="block py-2 px-4 hover:bg-gray-700">Logout</a></li>
            </ul>
        </nav>
    </div>

    

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('mySidebar');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuButton.addEventListener('click', toggleSidebar);

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
    </script>
</body>
</html>