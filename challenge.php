<?php
require "header.php";
require './libs/students.php';
$challenge = get_all_challenge();
disconnect_db();

if (!empty($_POST['check_chal'])) {
    $data['dapan'] = isset($_POST['dapan']) ? $_POST['dapan'] : '';
    // Validate thong tin
    $errors = array();
    if (empty($data['dapan'])) {
        header("location: challenge.php");
    }
    $fileee = "challenge\\" . $data['dapan'];
    if (file_exists($fileee)) {
        echo 'Đúng rồi'."<br>";
        $read = file($fileee);
        foreach ($read as $line) {
            echo $line."<br>";
        }
    } else {
//        header("location: challenge.php");
    }
}
?>

<div class="group-box">
    <div>
        <div align="center" class="title" id="dssv">Thử thách trí mạng</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <?php
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                header("location: index.php");
            }
            ?>
            <?php
            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '1') {
                echo "<a href=\"chal_add.php\"><b>Thêm thử thách</b></a> <br/> <br/>";
            }
            ?>

            <table id="customers">
                <tr style='background-color:green'>
                    <td><b style="color: white">STT</b></td>
                    <!--<td>Password</td>-->
                    <td><b style="color: white">Gợi ý</b></td>
                    <td><b style="color: white">Đáp án</b></td>
                    <td><b style="color: white">Action</b></td>
                </tr>
                <?php
//                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                foreach ($challenge as $item) {
                    ?>
                    <tr>
                    <form method="post" action="challenge.php">

                        <td><?php echo $item['challengeid']; ?></td>
                        <td><?php echo $item['goiy']; ?></td>
                        <td>
                            <input type="text" name="dapan" />    
                        </td>
                        <td>
                            <input type="submit" name="check_chal" value="Kiểm tra đáp án"/>
                        </td>
                    </form>
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