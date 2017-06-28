<?php
    $IS_DEBUG = true;
    if ($IS_DEBUG) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($IS_DEBUG) {
            foreach($_POST as $key => $entry) {
                if (is_array($entry)) {
                    print $key . ": " . implode(',', $entry) . "<br>";
                } else {
                    print $key . ": " . $entry . "<br>";
                }
            }
        }

        $original_name = $_FILES['fileToUpload']['name']; // include extension
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $temp_name = $_FILES['fileToUpload']['tmp_name'];
        $size = $_FILES['fileToUpload']['size'];
        $file_error = $_FILES['fileToUpload']['error'];
        $response = '';

        switch ($file_error) {
            case UPLOAD_ERR_OK:
                $is_valid = true;
                if (!isset($_POST['submit'])) {
                    $is_valid = false;
                    $response = 'Sorry, not set from submit button';
                } else if (!in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
                    $is_valid = false;
                    $response = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                } else if ($size/(1024 * 1024) > 5) {
                    $is_valid = false;
                    $response = 'File size is exceeding max allowed size(5M)';
                }
                if ($is_valid) {
                    $target_path = dirname( __FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_POST["hidden_folder_name"];
                    $target_file = $target_path . $_POST["hidden_filename"] . "." . $extension;
                    if (move_uploaded_file($temp_name, $target_file)) {
                        $response = 'Your file ' . $original_name . ' has been uploaded to '. $target_file;
                    } else {
                        $response = 'Sorry, there was an error uploading your file.';
                    }
                }
                break;
            case UPLOAD_ERR_INI_SIZE:
                $response = 'The uploaded file exceeds the upload_max_filesize (in php.ini. @See phpInfo())';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $response = 'The uploaded file exceeds the MAX_FILE_SIZE (specified in the HTML form)';
                break;
            case UPLOAD_ERR_PARTIAL:
                $response = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $response = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $response = 'Missing a temporary folder. Introduced in PHP 4.3.10, 5.0.3';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $response = 'Failed to write file to disk. Introduced in PHP 5.1.0';
                break;
            case UPLOAD_ERR_EXTENSION:
                $response = 'File upload stopped by extension. Introduced in PHP 5.2.0';
                break;
            default:
                $response = 'Unknown Error';
                break;
        }

        echo $response;
    } else {
        echo "Sorry, need POST request!";
    }
?>