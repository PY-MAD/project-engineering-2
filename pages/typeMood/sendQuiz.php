<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/db/connection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/project_eng_2/template/checkLogged.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $quizName = mysqli_real_escape_string($mysqli, $_POST["nameQuiz"]);
    $quizDesc = mysqli_real_escape_string($mysqli, $_POST["descQuiz"]);
    $userId = $_SESSION["userId"];
    
    if (!empty($quizName) && !empty($quizDesc) && !empty($_FILES['imageFile']['name'])) {
        // Handle the file upload
        $targetDir = "../../assets/costume_game_images/"; // Make sure this directory exists and is writable
        $originalFileName = pathinfo($_FILES["imageFile"]["name"], PATHINFO_FILENAME);
        $imageFileType = strtolower(pathinfo($_FILES["imageFile"]["name"], PATHINFO_EXTENSION));
        $timestamp = time(); // Get the current timestamp
        $newFileName = $originalFileName . "_" . $timestamp . "." . $imageFileType;
        $targetFile = $targetDir . $newFileName;
        $uploadOk = 1;
        $fileSize = $_FILES["imageFile"]["size"];

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        echo $_FILES["imageFile"]["size"];
        if ($_FILES["imageFile"]["size"] > 12500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars(basename($_FILES["imageFile"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        do {
            $token = bin2hex(random_bytes(16));

            // Prepare the statement
            $check_token = $mysqli->prepare("SELECT quiz_id FROM coustom_game WHERE quiz_id = ?");

            // Bind parameters and execute
            $check_token->bind_param("s", $token);
            $check_token->execute();
            $check_token->bind_result($count);

            // Fetch the result
            $check_token->fetch();
            $check_token->close();
        
        } while ($count > 0);

        // Prepare the insert statement
        $stmt = $mysqli->prepare("INSERT INTO coustom_game (quiz_id, user_id, name, description, image_url, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        if ($stmt === false) {
            die('Prepare failed: ' . $mysqli->error);
        }

        // Bind parameters and execute
        $stmt->bind_param("sisss", $token, $userId, $quizName, $quizDesc, $targetFile);
        if ($stmt->execute()) {
            // Set the session variable after a successful insert
            $_SESSION["lastQuiz"] = $token;
        } else {
            echo "Execute failed: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
