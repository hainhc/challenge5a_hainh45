<?php
require "header.php";
require './libs/students.php';


// Nếu người dùng submit form
if (!empty($_POST['add_exer'])) {
    // Lay data
    $data['Description'] = isset($_POST['Description']) ? $_POST['Description'] : '';
    $data['Creator'] = isset($_SESSION["User"]) ? $_SESSION["User"] : '';

// Validate thong tin
    $errors = array();
    if (!isset($_FILES["fileToUpload"]) || !isset($_SESSION["loggedin"])) {
        $errors['File'] = 'Chưa có file';
    }
    if (isset($_SESSION["Type"]) || $_SESSION["Type"] != '1') {
        $errors['File'] = 'Ko phai Giao vien';
    }

    if (empty($data['Creator'])) {
        $errors['Creator'] = 'Chưa nhập tên g vien';
    }

    // Neu ko co loi thi insert
    if ($errors) {
        // Trở về trang danh sách
        header("location: exer-add.php");
    }

    $target_file = "exam/" . $data['Creator'] . "_" . basename($_FILES["fileToUpload"]["name"]);
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
            db_add_baitap($data['Creator'], $target_file, $data['Description']);
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
            <?php
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                header("location: index.php");
            }
            ?>
            <form method="post" action="exer-add.php" enctype="multipart/form-data">
                <table id="customers">
                    <tr>
                        <td>Creator</td>
                        <td>
                            <?php
                            if (isset($_SESSION["User"])) {
                                echo $_SESSION["User"];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <input type="text" name="Description"/>
                        </td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="add_exer" value="Thêm"/>
                        </td>
                    </tr>
                </table>
            </form>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>