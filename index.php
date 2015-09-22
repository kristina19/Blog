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
	//$messages = get_messages($link);
	$id_user = $_SESSION['id_user'];
	$fullmessages = get_fullmessages($link);
	$messagesById = get_messagesById($link, $id_user);
	/* var_dump($id_user);
	var_dump(is_admin($link)); */
	/* echo '<pre>';
	print_r($fullmessages);
	echo '</pre>'; */
	
	include 'v/v_index.php';