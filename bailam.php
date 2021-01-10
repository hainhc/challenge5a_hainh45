<?php
require "header.php";
require './libs/students.php';

//if (!isset($_SESSION["type"]) || $_SESSION["type"] == '2') {
//    header("location: index.php");
//}
$exid = isset($_GET['exid']) ? $_GET['exid'] : '';
if ($exid) {
    $bailam = get_bailam($exid);
}
disconnect_db();
?>

<div class="group-box">
    <div>
        <div align="center" class="title" id="dssv">Danh sách bài làm</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <?php
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                header("location: index.php");
            }
            ?>
            <table id="customers">
                <tr style='background-color:green'>
                    <td><b style="color: white">Học sinh</b></td>
                    <!--<td>Password</td>-->
                    <td><b style="color: white">Lời nhắn</b></td>
                    <td><b style="color: white">Tải bài làm</b></td>
                </tr>
                <?php
//                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                foreach ($bailam as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item['Student']; ?></td>
                        <td><?php echo $item['Message']; ?></td>
                        <td><a href="download.php?file=<?php echo urlencode("student_exam\\" . $exid . "_" . $item['Student']) ?>"><?php echo $exid . "_" . $item['Student'] ?></a></td>
                    </tr>
                    <?php
                }
//                } else {
//                    echo "Đăng nhập đi rồi xem gì thì xem";
//                }
//                
                ?>
            </table>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>