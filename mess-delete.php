<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "header.php";
require './libs/students.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: sent.php");
}
// Thực hiện xóa
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
    $data = get_mess($id);
    if (!$data) {
        header("location: sent.php");
    }
    if (strcmp($_SESSION['User'], $data['messagefrom']) != 0)
        header("location: sent.php");
    delete_mess($id);
}

// Trở về trang danh sách
header("location: sent.php");
?>