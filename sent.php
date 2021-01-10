<?php
require "header.php";
require './libs/students.php';

if (!isset($_SESSION["User"])) {
    header("location: index.php");
}

$sent = get_sent($_SESSION["User"]);
disconnect_db();
?>

<div class="group-box">
    <div>
        <div align="center" class="title" id="dssv">Hộp thư đi</div>
        <div class="group-box-content" id="dssvtb">
            <table id="customers">
                <tr style='background-color:green'>
                    <td><b style="color: white">From</b></td>
                    <!--<td>Password</td>-->
                    <td><b style="color: white">Time</b></td>
                    <td><b style="color: white">Message</b></td>
                    <td><b style="color: white">Actions</b></td>
                </tr>
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                    foreach ($sent as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['messageto']; ?></td>
                            <td><?php echo $item['time']; ?></td>
                            <td><?php echo $item['messagetext']; ?></td>
                            <td>
                                <form method="post" action="student-delete.php">
                                    <input onclick="window.location = 'mess-edit.php?id=<?php echo $item['messageid'];  ?>'" type="button" value="Sửa"/>
                                    <input onclick="window.location = 'mess-delete.php?id=<?php echo $item['messageid']; ?>'" type="button" value="Xóa"/>
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