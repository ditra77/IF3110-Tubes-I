<?php
include "config.php";
session_start();
	if(!isset($_SESSION['id']))
		header("location:index.php");
$card_number = $_POST['card_number'];
$name_on_card = $_POST['name_on_card'];
$expired_date = date('Y-m-d', strtotime($_POST['expired_date']));
$username = $_SESSION['id']; 

mysql_query("INSERT INTO kartu_kredit (card_number, name_on_card, expired_date, username) VALUES ('$card_number', '$name_on_card', '$expired_date', '$username')");
header('Location: dashboard.php');
mysql_close($con);
?>