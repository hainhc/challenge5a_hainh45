<?php

require "header.php";
require './libs/students.php';

$target_dir = "student_exam/";
$errors = array();

if (!isset($_FILES["fileToUpload"]) || !isset($_SESSION["loggedin"])) {
    $errors['File'] = 'Chưa có file';
}

if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '1') {
    $errors['File'] = 'Giao vien';
}

if (!isset($_SESSION["User"])) {
    $errors['File'] = 'Giao vien';
}

$data['Exerid'] = isset($_POST['Exerid']) ? $_POST['Exerid'] : '';
$data['message'] = isset($_POST['message']) ? $_POST['message'] : '';

if (empty($data['Exerid'])) {
    $errors['password'] = 'Chưa nhập Exerid';
}

if ($errors) {
    alert("Lỗi");
    // Trở về trang danh sách
    header("location: ds_sinhvien.php");
}


$target_file = $target_dir . $data['Exerid']."_".$_SESSION["User"];
$file_name_upload = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($file_name_upload, PATHINFO_EXTENSION));



// Check if file already exists
if (file_exists($target_file)) {
    echo "Xin lỗi, bạn chỉ được nộp bài một lần."."<br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if ($fileType != "txt" && $fileType != "doc" && $fileType != "docx" && $fileType != "pdf") {
    echo "Sorry, only txt, doc, docx & pdf files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        db_upload_bailam($_SESSION["User"], $data['Exerid']);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
disconnect_db();
?>
<?php require "footer.php"; ?>