<?php
 include_once 'security.php'; 
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>

    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="https://niranjanbhatta.com.np/assets/smalllogo-5gRCzB8E.svg">
    <title>Login | Student Assignment Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="Log in to your Student Assignment Tracker account to manage and track your academic tasks efficiently.">
    <meta name="keywords" content="pm tools, project management software, project planner, project tracking software, project tracking tools, task manager, todoist, deadline tracking web app, assignment tracking system, task management tool, student assignment tracker, project deadline management, task notification system, online task manager, deadline reminder app, task collaboration platform, project management for startups">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
   
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="manifest" href="/manifest.json">
     
    
    <style>
    
        
        


        
    
    #installModal {
  background-color: rgba(0, 0, 0, 0.5);
}
        .primary {
            background: #3BEF80;
        }
        .text-primary {
            color: #3BEF80;
        }
        .login-with-google-btn {
              
        display: flex;
        align-items: center;
            display: inline-block;
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 12px 16px 12px 30px;
            border: none;
            border-radius: 3px;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
            color: #757575;
            font-size: 14px;
            font-weight: 500;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik00IDEwLjdDNDAtNiA1LTVIazkgOWUwMCwwIDUgMyIvPjwvZz48cGF0aCBkPSJNOCAyYzEuMyAwIDIuNS40IDMuNCAxLjNMMTUgMi4zQTkgOSAwIDAgMCAxIDVsMyAyLjRhNS40IDUuNCAwIDAgMSA1LTMuN3oiIGZpbGw9IiNFQTRDMzUiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDMuNmMxLjMgMCAyLjUuNCAzLjQgMS4zTDE1IDIuM0E5IDkgMCAwIDAgMSA1bDMgMi40YTUuNCA1LjQgMCAwIDEgNS0zLjZ6IiBmaWxsPSIjRkZGRkZGIiBmaWwtcnVsZT0ibm9uemVybyIvPjwvc3ZnPjwvZz48L3N2Zz4=");
            background-color: white;
            background-repeat: no-repeat;
            background-position: 10px center;
        }
        .login-with-google-btn:hover {
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25);
        }
        .login-with-google-btn:active {
            background-color: #eeeeee;
        }
        .login-with-google-btn:focus {
            outline: none;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25), 0 0 0 3px #c8dafc;
        }
        .login-with-google-btn:disabled {
            filter: grayscale(100%);
            background-color: #ebebeb;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
            cursor: not-allowed;
        }
        .send-mail-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
       
 #status {
  position: fixed;
  top: 105px;
  left: 0;
  text-align: center;
  font-size: 18px;
  z-index: 1000;
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
                    <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Forgot your password?</a>
                </div>
            </div>
            <button type="submit"
                class="w-full text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 primary font-bold">Sign
                in</button>
            <div class="mt-4 text-center">
                <span class="text-gray-600">Don't have an account?</span>
                <a href="#" class="text-sm text-primary hover:text-indigo-900 font-bold ">Sign up</a>
            </div>
            
<div class="mt-6 mb-5 flex flex-col items-center text-center">
        <span class="font-bold text-md mb-4">- - OR - -</span>
        <a href="<?php echo htmlspecialchars($authUrl); ?>" class="flex items-center justify-center w-auto py-2 px-4 bg-white border border-gray-300 rounded-full shadow-sm text-blue-500 font-medium hover:bg-gray-100">
            <img src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA" alt="Google Icon" class="h-6 mr-3">
            <span>Sign in with Google</span>
        </a>
    </div>


        </form>
    </div>
    <!-- Modal -->
<div id="installModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
  <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Install the App</h3>
    <p class="mb-6">Get quick access to this app by installing it on your device.</p>
    <div class="flex justify-end">
      <button id="installAppButton" class="mr-2 py-2 px-4 bg-blue-500 text-white rounded-lg">Install</button>
      <button id="closeModalButton" class="py-2 px-4 bg-gray-300 rounded-lg">Close</button>
    </div>
  </div>
</div>

    <a href="gmail/" class="send-mail-btn text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 primary font-bold">Send Mail</a>
     

     
</body>
<script src="scripts.js?v=<?php echo $version ?>"></script>
</html>

