<?php
session_start();
include_once "../header.php";

?>
<main class="content md:ml-64 transition-margin duration-500 flex flex-wrap">
    <div class="w-full p-4">
        <div class="container mx-auto max-w-5xl bg-gray-800 text-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6 text-center">ADD NOTICE</h1>
            <form id="assignmentForm" method="post" class="space-y-4">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="w-full">
                        <div>
                            <label for="assignment_question" class="block text-sm font-medium mb-1">notice:</label>
                            <textarea id="mytextarea" rows="25" class="w-full p-2 border border-gray-600 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" id="submitButton" class="w-full p-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400">Submit</button>
                        </div>
                    </div>

                 
                </div>
            </form>
        </div>
    </div>
</main>

<div id="loadingOverlay" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-16 w-16"></div>
</div>

<style>
    .loader {
        border-top-color: #3498db;
        animation: spin 1s infinite linear;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script src="script.js"></script>
<script>
tinymce.init({
    selector: '#mytextarea',  // Selector for the textarea
    plugins: 'advlist autolink lists link image charmap print preview anchor ' + 
             'searchreplace visualblocks code fullscreen insertdatetime media ' +
             'table paste code help wordcount',
             
    // Display the menubar including File and Edit
    menubar: 'file edit view insert format tools table help', 

    // Customize the toolbar for small screens
    toolbar: 'undo redo | formatselect | bold italic backcolor | ' +
             'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',

    // Responsive settings
    mobile: {
        menubar: true,  // Show the menubar on mobile devices
        toolbar: 'undo redo | bold italic | link image',  // Compact toolbar for mobile
    },
    
   
    resize: true,  // Allow manual resizing
    setup: function (editor) {
        editor.on('init', function () {
            console.log('Editor initialized.');
        });
    }
});
</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>