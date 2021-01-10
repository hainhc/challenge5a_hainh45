<?php
require "header.php";
require './libs/students.php';


// Nếu người dùng submit form
if (!empty($_POST['add_chal'])) {
    // Lay data
    $data['goiy'] = isset($_POST['goiy']) ? $_POST['goiy'] : '';

// Validate thong tin
    $errors = array();
    if (!isset($_FILES["fileToUpload"]) || !isset($_SESSION["loggedin"]) || !isset($_SESSION["Type"])) {
        $errors['File'] = 'Chưa có file';
    }
    if (isset($_SESSION["Type"]) && $_SESSION["Type"] != '1') {
        $errors['File'] = 'Ko phai Giao vien';
    }
    // Neu ko co loi thi insert
    if ($errors) {
        // Trở về trang danh sách
        header("location: exer-add.php");
    }

    $target_file = "challenge//" . basename($_FILES["fileToUpload"]["name"]);
    $file_name_upload = basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($file_name_upload, PATHINFO_EXTENSION));



// Check if file already exists
    if (file_exists($target_file)) {
        echo "Xin lỗi, file này đã được upload. Xin hãy đổi tên." . "<br>";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            db_add_chal($data['goiy']);
            header("location: challenge.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

disconnect_db();
?>

<div class="group-box">
    <div align="center">
        <div class="title" id="dssv">Thêm bài tập</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <a href="baitap.php">Trở về</a> <br/> <br/>
            <form method="post" action="chal_add.php" enctype="multipart/form-data">
                <?php
                if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                    header("location: index.php");
                }
                ?>
                <table id="customers">
                    <tr>
                        <td>Gợi ý</td>
                        <td>
                            <input type="text" name="goiy"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Đáp án</td>
                        <td>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="add_chal" value="Thêm"/>
                        </td>
                    </tr>
                </table>
            </form>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>