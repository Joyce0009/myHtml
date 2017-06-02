<?php
    // define variables and set to empty values
    $titleErr = "";
    $title = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        $checkResult = checkInputTitle() && checkImage($target_file, $imageFileType);

        // Check if $uploadOk is set to 0 by an error
        if (!$checkResult) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Sorry, need POST request!";
    }

    function correctInputText($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function checkInputTitle() {
        $checkResult = true;
        if (empty($_POST["title"])) {
            $titleErr = "Title is required.";
            $checkResult = false;
            echo $titleErr . "<br>";
        } else {
            $title = correctInputText($_POST["title"]);
            $checkResult = true;
            echo "Title: " . $title . "<br>";
        }
        return $checkResult;
    }

    function checkImage($target_file, $imageFileType) {
        $checkResult = true;
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $checkResult = true;
            } else {
                echo "File is not an image.";
                $checkResult = false;
            }
        }
        // Check if file already exists
//        if (file_exists($target_file)) {
//            echo "Sorry, file already exists.";
//            $checkResult = false;
//        }
        // Check file size. need small than 500kb
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $checkResult = false;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $checkResult = false;
        }
        return $checkResult;
    }
?>