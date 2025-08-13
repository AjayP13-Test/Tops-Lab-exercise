<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Directory to save uploads (make sure it exists and is writable)
$uploadDir = __DIR__ . '/uploads/';

// Create upload dir if not exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Check if file is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];

        // Validate file size (max 5MB)
        if ($fileSize > 5 * 1024 * 1024) {
            http_response_code(400);
            echo json_encode(['error' => 'File size exceeds 5MB limit']);
            exit;
        }

        // Validate file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid file type. Allowed: jpg, jpeg, png, gif']);
            exit;
        }

        // Sanitize file name and create unique file name
        $newFileName = uniqid('img_', true) . '.' . $fileExtension;

        $destPath = $uploadDir . $newFileName;

        // Move uploaded file to destination folder
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            echo json_encode([
                'success' => true,
                'message' => 'File uploaded successfully',
                'file_name' => $newFileName,
                'file_url' => 'uploads/' . $newFileName
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error moving uploaded file']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No file uploaded or upload error']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST']);
}
