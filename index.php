<?php
	include 'm/bd.php';
	include 'm/news.php';
	session_start();

	$link = connect();
	
	if (!$link){
		echo ("Не удалось подключиться: " . mysqli_connect_error());
		exit();
	}
	if (isset($_POST['add'])){
		header('Location: c/add.php');
		exit();
	}
	$messages = get_messages($link);
	
	include 'v/v_index.php';