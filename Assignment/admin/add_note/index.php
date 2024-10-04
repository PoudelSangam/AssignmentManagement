<?php
include_once "../../superAdmin/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add PDF to Database</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Overlay styling */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .overlay-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <main class="content md:ml-64 transition-margin duration-500 flex items-center justify-center min-h-screen">
        <!-- Overlay for processing -->
        <div class="overlay" id="overlay">
            <div class="overlay-content bg-white p-6 rounded-lg shadow-lg">
                <p class="text-lg">Uploading... Please wait.</p>
                <progress id="progressBar" value="0" max="100" class="w-full mt-4"></progress>
                <span id="status" class="block mt-2 text-sm"></span>
            </div>
        </div>

        <!-- Main Form Container -->
        <div class="w-full max-w-lg p-6 bg-white shadow-lg rounded-lg flex flex-col items-center">
            <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add Notes</h2>

            <form id="uploadForm" enctype="multipart/form-data" class="space-y-4 w-full">
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
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <select name="subject" id="subject" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="">Select Subject</option>
                        <!-- Dynamic Subject Options will go here -->
                    </select>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                </div>

                <!-- PDF File -->
                <div>
                    <label for="pdf" class="block text-sm font-medium text-gray-700">Select PDF File</label>
                    <input type="file" name="pdf" id="pdf" accept="application/pdf" class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="flex justify-center">
                    <input type="submit" value="Upload PDF" class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded-lg shadow-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const facultySelect = document.getElementById('faculty');
            const semesterSelect = document.getElementById('semester');
            const batchSelect = document.getElementById('batch');
            const subjectSelect = document.getElementById('subject');
            const overlay = document.getElementById('overlay');
            const progressBar = document.getElementById('progressBar');
            const status = document.getElementById('status');

            let subjectData = {};

            // Fetch subject data from the JSON file
            fetch('../addassignment/subjectData.json')
                .then(response => response.json())
                .then(data => {
                    subjectData = data;
                    updateSubjects(); // Initial call to populate subjects
                })
                .catch(error => {
                    console.error('Error fetching subject data:', error);
                    status.innerText = 'Error fetching subject data.';
                });

            // Function to update subject options
            function updateSubjects() {
                const faculty = facultySelect.value;
                const semester = semesterSelect.value;
                const batch = batchSelect.value;

                if (faculty && semester && batch) {
                    const subjects = subjectData[faculty]?.[batch]?.[semester] || [];
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>'; // Reset options
                    subjects.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject;
                        option.textContent = subject;
                        subjectSelect.appendChild(option);
                    });
                } else {
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>'; // Reset options
                }
            }

            // Event listeners to trigger subject updates
            facultySelect.addEventListener('change', updateSubjects);
            semesterSelect.addEventListener('change', updateSubjects);
            batchSelect.addEventListener('change', updateSubjects);

            // AJAX form submission with progress
            const uploadForm = document.getElementById('uploadForm');
            uploadForm.addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this);
                const xhr = new XMLHttpRequest();

                // Show overlay
                overlay.style.display = 'flex';

                // Monitor progress
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        progressBar.value = percentComplete;
                        status.innerText = Math.round(percentComplete) + '% uploaded';
                    }
                }, false);

                // Handle response
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Parse the JSON response
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                status.innerText = response.message; // Upload successful
                            } else {
                                status.innerText = 'Upload failed! ' + response.message; // Display error from backend
                            }
                        } catch (e) {
                            status.innerText = 'Unexpected response from server.';
                        }
                    } else {
                        status.innerText = 'Upload failed! Server responded with status ' + xhr.status + '.';
                    }

                    // Hide overlay after 2 seconds
                    // setTimeout(() => {
                    //     overlay.style.display = 'none';
                    //     progressBar.value = 0;
                    // }, 2000);
                };

                // Handle request error
                xhr.onerror = function () {
                    status.innerText = 'An error occurred while uploading. Please try again.';
                    setTimeout(() => {
                        overlay.style.display = 'none';
                        progressBar.value = 0;
                    }, 2000);
                };

                xhr.open('POST', 'upload_pdf.php', true); // Use correct server endpoint
                xhr.send(formData);
            });

            // Hide overlay when clicking outside of the overlay content
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.style.display = 'none';
                    progressBar.value = 0;
                }
            });
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
    
</body>
</html>
