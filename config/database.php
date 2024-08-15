<?php
date_default_timezone_set('Asia/Jakarta');
session_start();

$con = mysqli_connect('localhost','root','','dbbelajar-crud-native');

if (!$con) {
    die('Connect Error: ' . mysqli_connect_errno());
}

$site_url = 'http://localhost/belajar-crud-native/';