<?php
include_once "check_status.php";
include_once "header.php";
include_once "../db.php";
$semester = $_SESSION["semester"]; // Corrected to $_SESSION
// Fetch assignments from the database
$sql = "SELECT id, `time`, `dead-line`, subject, assignment_question, assignment_number 
        FROM assignmentlist 
        WHERE Semester = '$semester' 
        ORDER BY `time` DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="content md:ml-64 transition-margin duration-500">
    <!-- Main content goes here -->
    <div class="container mx-auto max-w-lg md:max-w-2xl lg:max-w-3xl bg-gray-800 text-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Assignment List</h1>

        <!-- Display assignments in a table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-white rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-700">ID</th>
                        <th class="py-2 px-4 border-b border-gray-700">Uploaded Time</th>
                        <th class="py-2 px-4 border-b border-gray-700">Deadline</th>
                        <th class="py-2 px-4 border-b border-gray-700">Subject</th>
                        <th class="py-2 px-4 border-b border-gray-700">Assignment Number</th>
                        <th class="py-2 px-4 border-b border-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='bg-gray-700 hover:bg-gray-600'>";
                            echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["time"]) . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["dead-line"]) . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["subject"]) . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-700'>" . htmlspecialchars($row["assignment_number"]) . "</td>";
                            echo "<td class='py-2 px-4 border-b border-gray-700'>";
                            echo "<a href='edit/edit_assignment.php?id=" . htmlspecialchars($row["id"]) . "' class='bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded mr-2'>Edit</a>";
                            echo "<a href='delete_assignment.php?id=" . htmlspecialchars($row["id"]) . "' class='bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded' onclick='return confirm(\"Are you sure you want to delete this assignment?\") '>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='py-4 text-center'>No assignments found</td></tr>";
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
