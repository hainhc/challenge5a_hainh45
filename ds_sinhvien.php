<?php
require "header.php";
require './libs/students.php';
$students = get_all_students();
disconnect_db();
?>

<div class="group-box">
    <div>
        <div align="center" class="title" id="dssv">Danh sách sinh viên</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <?php
            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '3') {
                echo "<a font-size=\"40\" href=\"student-add.php\"><b>Thêm sinh viên</b></a> <br/> <br/>";
            }
            ?>
            
            <table id="customers">
                <tr style='background-color:green'>
                    <td><b style="color: white">Username</b></td>
                    <!--<td><b>Password</b></td>-->
                    <td><b style="color: white">Name</b></td>
                    <td><b style="color: white">Email</b></td>
                    <td><b style="color: white">Phone</b></td>
                    <td><b style="color: white">Actions</b></td>
                </tr>
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                    foreach ($students as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['Username']; ?></td>
                            <!--<td><?php echo $item['password']; ?></td>-->
                            <td><?php echo $item['fullname']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td>
                                <form method="post" action="student-delete.php">
                                    <?php
                                    if (isset($_SESSION["Type"]) && ($_SESSION["Type"] == '1' || $_SESSION["Type"] == '3')) {
                                        echo "<input onclick=\"window.location = 'student-edit.php?id=" . $item['Username'] . "'\" type=\"button\" value=\"Sửa\"/>";
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '3') {
                                        echo "<input type=\"hidden\" name=\"id\" value=\"" . $item['Username'] . "\"/>";
                                        echo "<input onclick=\"return confirm('Bạn có chắc muốn xóa không?');\" type=\"submit\" name=\"delete\" value=\"Xóa\"/>";
                                    }
                                    ?>
                                    <input onclick="window.location = 'message.php?recv=<?php echo $item['Username']; ?>'" type="button" value="Nhắn tin"/>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "Đăng nhập đi rồi xem gì thì xem";
                }
                ?>
            </table>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>