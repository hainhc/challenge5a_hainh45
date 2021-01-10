<?php
require "header.php";
require './libs/students.php';
$id = isset($_SESSION['User']) ? $_SESSION['User'] : '';
if (empty($id)) {
    header("location: index.php");
}
if ($id) {
    $data = get_user($id);
}

// Nếu người dùng submit form
if (!empty($_POST['edit_user'])) {
    // Lay data
    $data_new['password'] = isset($_POST['password']) ? $_POST['password'] : '';
    $data_new['email'] = isset($_POST['email']) ? $_POST['email'] : '';
    $data_new['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';


    // Validate thong tin
    $errors = array();
    if (empty($data['Username'])) {
        $errors['Username'] = 'Chưa nhập tên sinh vien';
    }

    if (empty($data_new['password'])) {
        $errors['password'] = 'Không được để trống password';
    }

    // Neu ko co loi thi insert
    if (!$errors) {
        edit_user($id, $data_new['password'], $data['fullname'], $data_new['email'], $data_new['phone']);
        // Trở về trang danh sách
        header("location: info.php");
    }
}

disconnect_db();
?>

<div class="group-box">
    <div align="center">
        <div class="title" id="dssv">Cập nhật thông tin cá nhân</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <form method="post" action="info.php">
                <table id="customers">
                    <tr>
                        <td>Username</td>
                        <td><?php echo!empty($id) ? $id : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="text" name="password"/>
                            <?php if (!empty($errors['password'])) echo $errors['password']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo!empty($data['fullname']) ? $data['fullname'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <input type="text" name="email" value="<?php echo!empty($data['email']) ? $data['email'] : ''; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type="text" name="phone" value="<?php echo!empty($data['phone']) ? $data['phone'] : ''; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="edit_user" value="Lưu"/>
                        </td>
                    </tr>
                </table>
            </form>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>