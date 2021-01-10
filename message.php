<?php
require "header.php";
require './libs/students.php';


//Nếu bấm send message
if (!empty($_POST['send_mess'])) {
    $recv_1 = isset($_POST['rev']) ? $_POST['rev'] : '';
    $mes = isset($_POST['mes_text']) ? $_POST['mes_text'] : '';
    if (isset($_POST['mes_text'])) {
        $mes = htmlspecialchars($_POST['mes_text']);
    }
    if ($recv_1 && $mes) {
        send_message($_SESSION["User"], $recv_1, $mes);
//        send_message($_SESSION["User"], 'student1', 'thanh cong');
        header("location: sent.php");
    }
}
disconnect_db();
?>

<div class="group-box">
    <div align="center">
        <div class="title" id="dssv">Gửi tin nhắn</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <form method="post" action="message.php">
                <table width="50%" border="1" cellspacing="0" cellpadding="10" id="customers">
                    <tr>
                        <td>Người gửi</td>
                        <td>
                            <?php
                            if (isset($_SESSION["User"])) {
                                echo $_SESSION["User"];
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Người nhận</td>
                        <td>
                            <?php
                            $recv = isset($_GET['recv']) ? $_GET['recv'] : '';
                            if ($recv)
                                echo $recv;
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td>Tin nhắn</td>
                        <td>
                            <!--<input type="textarea" rows="5" name="fullname" value="<?php echo!empty($data['fullname']) ? $data['fullname'] : ''; ?>"/>-->
                            <textarea placeholder="Nhắn lời yêu thương thôi nhé." id="text" name="mes_text" rows="4" style="overflow: hidden; word-wrap: break-word; resize: none; "></textarea>
                            <!--<textarea placeholder="Enter something funny." id="text" name="texttttt" rows="4" style="overflow: hidden; word-wrap: break-word; resize: none; "></textarea>-->
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="rev" value="<?php echo $recv ?>"/>
                            <input type="submit" name="send_mess" value="Gửi"/>
                        </td>
                    </tr>
                </table>
            </form>
            <p> </p>
        </div>
    </div>
</div>		
<?php require "footer.php"; ?>