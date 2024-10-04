<?php
include_once '../header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>send packagesr</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
         .primary{
        background:#3BEF80;
    }
    .send-title{
         color:#61BCE9;
     }
    </style>
</head>
<body class="bg-gray-100 ">
    <section class="mt-10 max-w-lg w-full mx-auto bg-white shadow-lg rounded-lg p-8 mb-24">
        <div class="container">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 send-title">Send Package</h1>
            <form id="uploadForm" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                    <input type="text" id="subject" name="Subject" required
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="gmail" class="block text-sm font-medium text-gray-700">Your Gmail:</label>
                    <input type="email" id="gmail" name="Gmail" required
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Upload Your Code:</label>
                    <textarea id="code" name="code" rows="10"
                        class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700">Upload Images:</label>
                    <input type="file" id="files" name="attachments[]" multiple
                        class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="hidden" id="progressContainer">
                    <label class="block text-sm font-medium text-gray-700">Processing:</label>
                    <progress id="processingProgress" value="0" max="100" class="w-full"></progress>
                </div>
                <div>
                    <button id="processing" class="btn w-full primary text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">
                        Convert to PDF and Send to Gmail
                    </button>
                </div>
            </form>
            <div id="resultMessage" class="mt-4 text-center text-gray-700"></div>
        </div>
    </section>
<?php
include_once '../footer.php';
?>
    <script src="script.js"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4292260109375127"
     crossorigin="anonymous"></script>
</body>
</html>


