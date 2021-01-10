<?php
require "header.php";
require './libs/students.php';

if (!isset($_SESSION["User"])) {
    header("location: index.php");
}

$inbox = get_inbox($_SESSION["User"]);
disconnect_db();
?>

<div class="group-box">
    <div>
        <div align="center" class="title" id="dssv">Hộp thư đến</div>
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
                    foreach ($inbox as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['messagefrom']; ?></td>
                            <td><?php echo $item['time']; ?></td>
                            <td><?php echo $item['messagetext']; ?></td>
                            <td>
                                <input onclick="window.location = 'message.php?recv=<?php echo $item['messagefrom']; ?>'" type="button" value="Reply"/>
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