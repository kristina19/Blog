<?php
	include '../m/bd.php';
	include '../m/news.php';
	session_start();

	if(!is_auth()){
		header('Location: login.php');
		exit();
	}
	
	$link = connect();
	
	if (!$link){
		echo ("Не удалось подключиться: " . mysqli_connect_error());
		exit();
	}

	$id = (int)$_GET['id'];

 	if($id != ''){
		$content = get_content($link, $id);
		$content = $content['content'];
		$messages = get_messages($link);
		for ($i = 0; $i < count($messages); $i++) 
		{ 
			if ($messages[$i]['id_new'] == $id)
				$title = $messages[$i]['name']; 
		}
	}
	else
		$content = 'Ошибка 404 - такой статьи нет!';
	
 	if (isset($_POST['Delete'])){
		delete_new($link, $id);
		header('Location: ../index.php');
		exit(); 
	} 
	
	elseif(isset($_POST['Save'])){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);

		if($content == ''){
			$message = "Незаполнено поле контент, а надо бы :)";
		}
		elseif(mb_strlen($content) > 1000){
			$message = "Статья превышает 1000 знаков! Будьте лаконичны ;)";
		}
		elseif(new_exists($link, $id)){
			update_new($link, $id, $content, $title);
			header('Location: ../index.php');
			exit();	
		} 
		else{
			add_new($link, $title, $content, $id_user);
			header('Location: ../index.php');
			exit();	
		}		
	}
	else{
		$message = '';
		$title = $title;
		$content = $content;
	}
include '../v/v_edit.php';