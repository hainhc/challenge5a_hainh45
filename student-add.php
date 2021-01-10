<?php
require "header.php";
require './libs/students.php';

if (!isset($_SESSION["Type"]) || $_SESSION["Type"] != '3') {
    header("location: index.php");
}
// Nếu người dùng submit form
if (!empty($_POST['add_student']))
{
    // Lay data
    $data['Username']        = isset($_POST['Username']) ? $_POST['Username'] : '';
    $data['password']         = isset($_POST['password']) ? $_POST['password'] : '';
    $data['fullname']    = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $data['email']        = isset($_POST['email']) ? $_POST['email'] : '';
    $data['phone']         = isset($_POST['phone']) ? $_POST['phone'] : '';
     
    // Validate thong tin
    $errors = array();
    if (empty($data['Username'])){
        $errors['Username'] = 'Chưa nhập tên sinh vien';
    }
     
    if (empty($data['password'])){
        $errors['password'] = 'Chưa nhập pass sinh vien';
    }
     
    // Neu ko co loi thi insert
    if (!$errors){
        add_student($data['Username'], $data['password'], $data['fullname'], $data['email'], $data['phone']);
        // Trở về trang danh sách
        header("location: ds_sinhvien.php");
    }
}
 
disconnect_db();
?>

<div class="group-box">
    <div align="center">
        <div class="title" id="dssv">Thêm sinh viên</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <h1>Thêm sinh viên </h1>
            <a href="ds_sinhvien.php">Trở về</a> <br/> <br/>
        <form method="post" action="student-add.php">
            <table id="customers">
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="Username" value="<?php echo !empty($data['Username']) ? $data['Username'] : ''; ?>"/>
                        <?php if (!empty($errors['Username'])) echo $errors['Username']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="text" name="password" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>"/>
                        <?php if (!empty($errors['password'])) echo $errors['password']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="fullname" value="<?php echo !empty($data['fullname']) ? $data['fullname'] : ''; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>
                        <input type="text" name="phone" value="<?php echo !empty($data['phone']) ? $data['phone'] : ''; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_student" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>