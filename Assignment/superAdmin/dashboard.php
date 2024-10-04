<?php
include_once "header.php";
include_once "../db.php";

// Fetch assignments from the database
$sql = "SELECT id, name, gmail, phonenumber, status FROM cr ORDER BY time DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="content md:ml-64 transition-margin duration-500">
    <!-- Main content goes here -->
    <div class="container mx-auto max-w-lg md:max-w-2xl lg:max-w-4xl bg-gray-800 text-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">CR List</h1>

        <!-- Display assignments in a table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-white rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-700">ID</th>
                        <th class="py-2 px-4 border-b border-gray-700">NAME</th>
                        <th class="py-2 px-4 border-b border-gray-700">EMAIL</th>
                        <th class="py-2 px-4 border-b border-gray-700">PHONE NUMBER</th>
                        <th class="py-2 px-4 border-b border-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            if ($row["status"] !== "active") {
                                echo "<tr class='bg-gray-700 hover:bg-gray-600'>";
                                echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["id"]) . "</td>";
                                echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["name"]) . "</td>";
                                echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["gmail"]) . "</td>";
                                echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["phonenumber"]) . "</td>";
                                echo "<td class='py-2 px-4 border-b border-gray-700'>";
                                echo "<a href='accept_Cr.php?id=" . htmlspecialchars($row["id"]) . "' class='bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded mr-2' onclick='return confirm(\"Are you sure you want to Accept ?\")'>Accept</a>";
                                echo "<a href='delete_Cr.php?id=" . htmlspecialchars($row["id"]) . "' class='bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded' onclick='return confirm(\"Are you sure you want to delete ?\")'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                     
                        }
                    } else {
                        echo "<tr><td colspan='6' class='py-4 text-center'>No cr found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>

<?php

// Close the database connection
$conn->close();
?>
