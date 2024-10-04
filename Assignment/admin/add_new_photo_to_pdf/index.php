<?php
include_once "../../superAdmin/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Image to PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-white-100">
    <main class="content md:ml-64 transition-margin duration-500">
        <div class="flex items-center justify-center min-h-screen">
        <div class="container mx-auto max-w-lg md:max-w-1xl lg:max-w-1xl bg-gray-800 text-black p-1 rounded-lg shadow-md mt-15">
            <div class="w-full max-w-lg p-6 bg-white shadow-lg rounded-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add Image to PDF</h2>

                <form id="pdfForm" class="space-y-4">
                    <!-- Faculty -->
                    <div>
                        <label for="faculty" class="block text-sm font-medium text-gray-700">Faculty</label>
                        <select name="faculty" id="faculty" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="">Select Faculty</option>
                            <option value="bct">BCT</option>
                            <option value="bei">BEI</option>
                            <option value="bce">BCE</option>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                        <select name="semester" id="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                <option value="<?php echo "Semester ".$i; ?>">Semester <?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <!-- Batch -->
                    <div>
                        <label for="batch" class="block text-sm font-medium text-gray-700">Batch</label>
                        <select name="batch" id="batch" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <option value="new">New</option>
                            <option value="old">Old</option>
                        </select>
                    </div>

                    <!-- Subject -->
                    <div id="subject-container" class="hidden">
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <select name="subject" id="subject" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            <!-- Dynamic Subject Options will go here -->
                        </select>
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Select Image to add</label>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:border-indigo-500 focus:ring-indigo-500" required>
                    </div>
                    
                     <div id="responseMessage" class="mt-6 text-center"></div>

                    <div class="flex justify-center">
                        <button type="submit" class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded-lg shadow-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </main>

    <script>
        let subjectData = {};

        fetch('../addassignment/subjectData.json')
            .then(response => response.json())
            .then(data => {
                subjectData = data;
                console.log("Loaded subject data:", subjectData);
            });

        const facultySelect = document.getElementById('faculty');
        const semesterSelect = document.getElementById('semester');
        const batchSelect = document.getElementById('batch');
        const subjectSelect = document.getElementById('subject');
        const subjectContainer = document.getElementById('subject-container');

        function updateSubjects() {
            const selectedFaculty = facultySelect.value;
            const selectedSemester = semesterSelect.value;
            const selectedBatch = batchSelect.value;

            subjectSelect.innerHTML = '';

            if (subjectData[selectedFaculty] && subjectData[selectedFaculty][selectedBatch] && subjectData[selectedFaculty][selectedBatch][selectedSemester]) {
                const subjects = subjectData[selectedFaculty][selectedBatch][selectedSemester];
                subjectContainer.classList.remove('hidden');
                subjects.forEach(subject => {
                    const option = document.createElement('option');
                    option.value = subject;
                    option.textContent = subject;
                    subjectSelect.appendChild(option);
                });
            } else {
                subjectContainer.classList.add('hidden');
            }
        }

        facultySelect.addEventListener('change', updateSubjects);
        semesterSelect.addEventListener('change', updateSubjects);
        batchSelect.addEventListener('change', updateSubjects);

        $('#pdfForm').on('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            $.ajax({
                url: 'modify_pdf.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#responseMessage').html('<p class="text-green-500">' + response + '</p>');
                },
                error: function() {
                    $('#responseMessage').html('<p class="text-red-500">Error submitting form</p>');
                }
            });
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
</body>
</html>
