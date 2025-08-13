<?php
if (isset($_POST['upload'])) {
    $uploadDir = __DIR__ . '/uploads/'; // Folder to store files
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = basename($_FILES['userfile']['name']);
    $fileTmpPath = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ['pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg'];

    // Validation
    if (!in_array($fileType, $allowedTypes)) {
        die("❌ Invalid file type. Only PDF, DOC, DOCX, PNG, JPG allowed.");
    }
    if ($fileSize > 2 * 1024 * 1024) { // 2MB limit
        die("❌ File is too large. Max 2MB allowed.");
    }

    // Prevent overwriting
    $newFileName = uniqid('doc_', true) . '.' . $fileType;
    $destination = $uploadDir . $newFileName;

    // Move file securely
    if (move_uploaded_file($fileTmpPath, $destination)) {
        echo "✅ File uploaded successfully! Stored as: " . htmlspecialchars($newFileName);
    } else {
        echo "❌ Error uploading file.";
    }
}
