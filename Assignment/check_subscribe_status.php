<?php
session_start();
include_once "db.php";
include_once "version.php";

$user = $_SESSION['user'];
$email = $user['email'];

// Query to check if the endpoint, auth, and p256dh fields have values
$sql = "SELECT endpoint, auth, p256dh FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($endpoint, $auth, $p256dh);
$stmt->fetch();

// Show modal if the user is not subscribed
if (empty($endpoint) && empty($auth) && empty($p256dh)) {
    ?>

    <!-- Modal -->
    <div id="subscribeModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Welcome</h3>
            <p class="mb-6">It looks like you’re not subscribed to notifications</p>
            <div class="flex justify-end">
                <button id="subscribeButton2" class="mr-2 py-2 px-4 bg-blue-500 text-white rounded-lg">Yes</button>
            </div>
        </div>
    </div>

    <!-- Blur Background -->
     <div id="blurBackground" class="fixed inset-0 bg-gray-500 opacity-70 backdrop-blur-sm"></div>

    <!-- CSS for blur effect -->
    <style>
        #blurBackground {
            display: none; /* Hidden by default, will show when modal is active */
        }
    </style>

    <script>
        const modal = document.getElementById("subscribeModal");
        const subscribeButton = document.getElementById("subscribeButton2");
        const blurBackground = document.getElementById("blurBackground");

        // Show the blur background and modal
        blurBackground.style.display = "block";

        // Hide modal and remove blur on button click
        subscribeButton.addEventListener("click", function() {
            modal.style.display = "none";
            blurBackground.style.display = "none";
        });
    </script>

    <?php
}
?>
<script src="./js/subscription.js"></script>
