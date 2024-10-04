<?php
include_once "../header.php";
include_once "../../db.php";



if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM assignmentlist WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $assignment = $result->fetch_assoc();

    if (!$assignment) {
        die("Assignment not found.");
    }
} else {
    die("Invalid assignment ID.");
}
?>

<main class="content md:ml-64 transition-margin duration-500">
    <div class="p-4">
        <div class="container mx-auto max-w-lg md:max-w-2xl lg:max-w-3xl bg-gray-800 text-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Edit Assignment Details</h1>
            <form id="editAssignmentForm" method="post" class="space-y-4">
                <!-- Deadline Input -->
                <div>
                    <label for="deadline" class="block text-sm font-medium mb-1">Deadline:</label>
                    <input type="hidden" id="assignment_id" name="id" value="<?php echo htmlspecialchars($assignment['id']); ?>">

                    <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($assignment['dead-line']); ?>" required class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- Assignment Number Input -->
                <div>
                    <label for="assignment_number" class="block text-sm font-medium mb-1">Assignment Number:</label>
                    <input type="number" id="assignment_number" name="assignment_number" value="<?php echo htmlspecialchars($assignment['assignment_number']); ?>" required class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <!-- Subject Selector -->
                <div>
                    <label for="subject" class="block text-sm font-medium mb-1">Subject:</label>
                    <select id="subject" name="subject" required class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Subject</option>
                        <option value="COA" <?php echo $assignment['subject'] == 'COA' ? 'selected' : ''; ?>>COA</option>
                        <option value="Instrumentation" <?php echo $assignment['subject'] == 'Instrumentation' ? 'selected' : ''; ?>>Instrumentation</option>
                        <option value="Probability" <?php echo $assignment['subject'] == 'Probability' ? 'selected' : ''; ?>>Probability</option>
                        <option value="Software" <?php echo $assignment['subject'] == 'Software' ? 'selected' : ''; ?>>Software</option>
                        <option value="Data Communication" <?php echo $assignment['subject'] == 'Data Communication' ? 'selected' : ''; ?>>Data Communication</option>
                        <option value="Graphics" <?php echo $assignment['subject'] == 'Graphics' ? 'selected' : ''; ?>>Graphics</option>
                        <option value="English" <?php echo $assignment['subject'] == 'English' ? 'selected' : ''; ?>>English</option>
                    </select>
                </div>

                <!-- Assignment Question with TinyMCE Editor -->
                <div>
                    <label for="assignment_question" class="block text-sm font-medium mb-1">Assignment Question:</label>
                    <textarea id="mytextarea" name="assignment_question" rows="10" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo $assignment['assignment_question']; ?></textarea>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="w-full p-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="script.js"></script>
<script>
        tinymce.init({
            selector: '#mytextarea',  // Selector for the textarea to convert into TinyMCE
            plugins: 'advlist autolink lists link image charmap print preview anchor ' + 
                     'searchreplace visualblocks code fullscreen ' +
                     'insertdatetime media table paste code help wordcount',   // List of plugins
            toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
                     'alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist outdent indent | removeformat | help | ' +
                     'link image media table | code',  // Configure the toolbar
            menubar: 'file edit view insert format tools table help', // Menubar options
            setup: function (editor) {
                editor.on('init', function () {
                    console.log('Editor is initialized.');
                });
            }
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>

<?php
$conn->close();
?>
