<?php
require "header.php";
require './libs/students.php';
$user = get_teacher();
disconnect_db();
?>

<div class="group-box">
    <div align="center">
        <div class="title" id="dssv">Danh sách giáo viên</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <!--<table width="100%" align="center" border="1" class="table table-bordered cart_summary">-->
            <table id="customers">
                <tr style='background-color:green'>
                    <td><b style="color: white">Username</b></td>
                    <td><b style="color: white">Password</b></td>
                    <td><b style="color: white">Name</b></td>
                    <td><b style="color: white">Email</b></td>
                    <td><b style="color: white">Phone</b></td>
                    <td><b style="color: white">Actions</b></td>
                </tr>
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                    foreach ($user as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['Username']; ?></td>
                            <td><?php echo $item['password']; ?></td>
                            <td><?php echo $item['fullname']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td>
                                <form method="post" action="student-delete.php">
                                    <input onclick="window.location = 'message.php?recv=<?php echo $item['Username']; ?>'" type="button" value="Nhắn tin"/>
                                    <input type="hidden" name="id" value="<?php echo $item['Username']; ?>"/>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "Đăng nhập đi rồi xem gì thì xem.";
                }
                ?>

            </table>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>