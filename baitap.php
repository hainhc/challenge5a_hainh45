<?php
require "header.php";
require './libs/students.php';
$exercise = get_all_exercise();
disconnect_db();
?>

<div class="group-box">
    <div>
        <div align="center" class="title" id="dssv">Danh sách bài tập</div>
        <div class="group-box-content" id="dssvtb">
            <!--<table width="100%" border="1" cellspacing="0" cellpadding="10">-->
            <?php
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
                header("location: index.php");
            }
            ?>
            <?php
            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '1') {
                echo "<a href=\"exer-add.php\"><b>Thêm bài tập</b></a> <br/> <br/>";
            }
            ?>

            <table id="customers">
                <tr style='background-color:green'>
                    <td><b style="color: white">Creator</b></td>
                    <!--<td>Password</td>-->
                    <td><b style="color: white">Description</b></td>
                    <td><b style="color: white">ExerciseFilePath</b></td>
                    <td><b style="color: white">Action</b></td>
                </tr>
                <?php
//                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                foreach ($exercise as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item['Createtor']; ?></td>
                        <td><?php echo $item['Description']; ?></td>
                        <td><a href="download.php?file=<?php echo urlencode($item['ExerciseFilePath']) ?>"><?php echo $item['ExerciseFilePath']?></a></td>
                        <td>
                            <!--                            <form method="post" action="student-delete.php">
                            <?php
                            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '1') {
                                echo "<input onclick=\"window.location = 'bailam.php?exid=" . $item['ExerciseID'] . "'\" type=\"button\" value=\"Xem bài nộp\"/>";
                            }
                            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '2') {
//                                    echo "<input onclick=\"window.location = 'student-edit.php?id=" . $item['ExerciseID'] . "'\" type=\"button\" value=\"Nộp bài\"/>";
                            }
                            ?>
                                                        </form>-->
                            <?php
                            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '1') {
                                ?>
                                <form method="post" action="student-delete.php">
                                    <?php echo "<input onclick=\"window.location = 'bailam.php?exid=" . $item['ExerciseID'] . "'\" type=\"button\" value=\"Xem bài nộp\"/>"; ?>
                                </form>

                                <?php
                            }
                            if (isset($_SESSION["Type"]) && $_SESSION["Type"] == '2') {
                                ?>
                                <form action="nopbai.php" method="post" enctype="multipart/form-data">
                                    Chọn file bài làm:
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                    <input type="hidden" name="Username" value="<?php echo $_SESSION["User"]; ?>"/>
                                    <input type="hidden" name="Exerid" value="<?php echo $item["ExerciseID"]; ?>"/>
                                    <input type="submit" value="Nộp bài" name="submit">
                                </form>
                                <?php
                            }
                            ?>
                        </td>
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