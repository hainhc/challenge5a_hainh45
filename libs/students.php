<?php

// Biến kết nối toàn cục
global $conn;

function x() {
    echo '1';
}

// Hàm kết nối database
function connect_db() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$conn) {
        $conn = mysqli_connect('localhost:3306', 'hainh45', 'Viettel@2020', 'qldaotao');
        // Thiết lập font chữ kết nối
        mysqli_set_charset($conn, 'utf8');
    }
}

// Hàm ngắt kết nối
function disconnect_db() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn) {
        mysqli_close($conn);
    }
}

// Hàm lấy tất cả sinh viên
function get_all_students() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM info WHERE permiss = '2'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Lặp qua từng record và đưa vào biến kết quả
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

function get_all_user() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM info";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Lặp qua từng record và đưa vào biến kết quả
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

function get_teacher() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM info WHERE permiss = '1'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Lặp qua từng record và đưa vào biến kết quả
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

// Hàm lấy sinh viên theo ID
function get_student($student_id) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM info WHERE permiss = '2' AND Username = '{$student_id}'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    // Trả kết quả về
    return $result;
}

// Hàm thêm sinh viên
function add_student($student_user, $student_pass, $student_name, $student_email, $student_phone) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $student_user = addslashes($student_user);
    $student_pass = addslashes($student_pass);
    $student_name = addslashes($student_name);
    $student_email = addslashes($student_email);
    $student_phone = addslashes($student_phone);

    // Câu truy vấn thêm
    $sql = "
            INSERT INTO info(Username, password, fullname, email, phone, permiss) 
            VALUES ('$student_user','$student_pass','$student_name','$student_email','$student_phone','2')
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

// Hàm sửa sinh viên
function edit_student($student_user, $student_pass, $student_name, $student_email, $student_phone) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $student_user = addslashes($student_user);
    $student_pass = addslashes($student_pass);
    $student_name = addslashes($student_name);
    $student_email = addslashes($student_email);
    $student_phone = addslashes($student_phone);

    // Câu truy sửa
    $sql = "
            UPDATE info SET
            password = '$student_pass',
            fullname = '$student_name',
            email = '$student_email',
            phone = '$student_phone',
            permiss = '2'
            WHERE Username = '$student_user'
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

// Hàm xóa sinh viên
function delete_student($student_id) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    $student_id = addslashes($student_id);
    // Câu truy sửa
    $sql = "
            DELETE FROM info
            WHERE Username = '$student_id'
    ";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

// Hàm gửi tin nhắn
function send_message($sender, $receiver, $message) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $sender = addslashes($sender);
    $receiver = addslashes($receiver);
    $message = addslashes($message);
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time = date("Y-m-d h:i:sa");
    // Câu truy sửa
    $sql = "
            INSERT INTO message(messagefrom, messageto, messagetext,time) 
            VALUES ('$sender','$receiver','$message','$time');
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

function get_all_exercise() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM exercise";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Lặp qua từng record và đưa vào biến kết quả
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

// Hàm lấy sinh viên theo ID
function get_bailam($exercise_id) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM student_exam WHERE ExerciseID = '{$exercise_id}'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Nếu có kết quả thì đưa vào biến $result
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

// Hàm lấy thư đến theo id
function get_inbox($to) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM message WHERE messageto = '{$to}'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Nếu có kết quả thì đưa vào biến $result
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

// Hàm lấy thư đến theo id
function get_sent($from) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM message WHERE messagefrom = '{$from}'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Nếu có kết quả thì đưa vào biến $result
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

// Hàm lấy thư đến theo id
function get_mess($id) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM message WHERE messageid = '{$id}'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    // Trả kết quả về
    return $result;
}

// Hàm nộp bài làm
function db_upload_bailam($student, $exerid) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $student = addslashes($student);
    $exerid = addslashes($exerid);
    // Câu truy vấn
    $sql = "
            INSERT INTO student_exam(Student, ExerciseID) 
            VALUES ('$student','$exerid');
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

// Hàm thêm bài tập
function db_add_baitap($teacher, $ExerciseFilePath, $Desc) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $teacher = addslashes($teacher);
    $ExerciseFilePath = addslashes($ExerciseFilePath);
    $Desc = addslashes($Desc);
    // Câu truy vấn
    $sql = "
            INSERT INTO exercise(Createtor, ExerciseFilePath, Description) 
            VALUES ('$teacher','$ExerciseFilePath', '$Desc');
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

function get_all_challenge() {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM challenge";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Lặp qua từng record và đưa vào biến kết quả
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

// Hàm thêm bài tập
function db_add_chal($goiy) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $goiy = addslashes($goiy);
    // Câu truy vấn
    $sql = "
            INSERT INTO challenge(goiy) 
            VALUES ('$goiy');
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

// Hàm lấy user theo ID
function get_user($sid) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy tất cả sinh viên
    $sql = "SELECT * FROM info WHERE Username = '{$sid}'";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }

    // Trả kết quả về
    return $result;
}

// Hàm sửa sinh viên
function edit_user($suser, $pass, $student_name, $student_email, $student_phone) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $suser = addslashes($suser);
    $pass = addslashes($pass);
    $student_email = addslashes($student_email);
    $student_phone = addslashes($student_phone);

    // Câu truy sửa
    $sql = "
            UPDATE info SET
            password = '$pass',
            email = '$student_email',
            phone = '$student_phone'
            WHERE Username = '$suser'
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

// Hàm xóa tin nhắn
function delete_mess($mess_id) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    $mess_id = addslashes($mess_id);
    // Câu truy sửa
    $sql = "
            DELETE FROM message
            WHERE messageid = '$mess_id'
    ";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

function edit_mess($id, $message) {
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $id = addslashes($id);
    $message = addslashes($message);

    // Câu truy sửa
    $sql = "
            UPDATE message SET
            messagetext = '$message'
            WHERE messageid = '{$id}'
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}