<?php
require "header.php";
require './libs/students.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $data_id = get_mess($id);
}

// Nếu không có dữ liệu tức không tìm thấy sinh viên cần sửa
if (!$data_id) {
    header("location: sent.php");
}

// Nếu người dùng submit form
if (!empty($_POST['edit_mess'])) {
    if (strcmp($_SESSION['User'], $data_id['messagefrom']) != 0)
        header("location: sent.php");
// Lay data    
    $data['mess_text'] = isset($_POST['mess_text']) ? $_POST['mess_text'] : '';
//    if (strcmp($_SESSION['User'], $data_id['messagefrom']) != 0)
//        header("location: sent.php");
    // Neu ko co loi thi insert
    edit_mess($id, $data['mess_text']);
    // Trở về trang danh sách
    header("location: sent.php");
}

disconnect_db();
?>

<div class="group-box">
    <div align="center">
        <div class="title" id="dssv">Sửa tin nhắn</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->

            <form method="post" action="mess-edit.php?id=<?php echo $id; ?>">
                <table id="customers">
                    <tr>
                        <td>Người gửi</td>
                        <td><?php echo!empty($data_id['messagefrom']) ? $data_id['messagefrom'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Người nhận</td>
                        <td><?php echo!empty($data_id['messageto']) ? $data_id['messageto'] : ''; ?></td>
                    </tr>
                    <tr>
                        <td>Nội dung</td>
                        <td><input type="text" name="mess_text" value="<?php echo!empty($data_id['messagetext']) ? $data_id['messagetext'] : ''; ?>"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="edit_mess" value="Lưu"/>
                        </td>
                    </tr>
                </table>
            </form>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>