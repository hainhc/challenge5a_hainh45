<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "header.php";
require './libs/students.php';

if (!isset($_SESSION['Type']) || $_SESSION['Type'] != '3')
{
    header("location: index.php");
}
// Thực hiện xóa
$id = isset($_POST['id']) ? $_POST['id'] : '';
if ($id){
    delete_student($id);
}
 
// Trở về trang danh sách
header("location: ds_sinhvien.php");
?>