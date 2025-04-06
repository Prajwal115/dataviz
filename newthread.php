<?php
session_start();

?>
<html>
    <head>
        <title>First Thread</title>
        <link rel="stylesheet" href = "CSS/new.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <style>

        body{
            overflow-y:scroll;
        }
    </style>

    <body>
    <nav>
        <img src="IMG/logo black.png" id="logo" alt="Logo">
        <div>

            <a href="chats.php">My Threads</a>
            <a href="downloads.php">Downloads</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>
    <div id="myProgress">
  <div id="myBar"></div>
</div>

<div class = "main" id = 'main'>
    <h1>Upload The File</h1>
    <p>Provide your data file to unlock powerful AI-driven analysis.</p>



    <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="upload-box">
                <input type="file" id="fileInput" name="file" accept=".csv, .json" onchange="handleFileChange(this)">
                <i class="material-icons">add_circle</i>  <label for="fileInput" class="block">
                    <p id="fileInputText" class="upload-text">
                        <span class="font-semibold">Click to upload</span> or drag and drop
                    </p>
                    <p class="text-xs text-gray-500 mt-2">Supported files: CSV, JSON</p>
                </label>
            </div>
            <div id="fileInfo" class="file-info hidden">
            </div>
            <button type="submit" class="upload-button">
                Upload File
            </button>
            <div id="uploadStatus" class="upload-status"></div>
        </form>
    </div>
        <script>
        const fileInput = document.getElementById('fileInput');
        const fileInputText = document.getElementById('fileInputText');
        const fileInfo = document.getElementById('fileInfo');
        const fileNameDisplay = document.getElementById('fileName');
        const fileSizeDisplay = document.getElementById('fileSize');
        const uploadForm = document.getElementById('uploadForm');
        const uploadStatus = document.getElementById('uploadStatus');

        function handleFileChange(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileInputText.textContent = `File chosen: ${file.name}`;
                //fileNameDisplay.textContent = file.name;
                //fileSizeDisplay.textContent = ` (${(file.size / 1024).toFixed(2)} KB)`;
                fileInfo.classList.remove('hidden');
            } else {
                fileInputText.innerHTML = '<span class="font-semibold">Click to upload</span> or drag and drop';
                fileInfo.classList.add('hidden');
            }
        }


    </script>

</body>
</html>