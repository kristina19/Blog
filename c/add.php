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

	
	if(count($_POST) > 0){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		$id_user = $_SESSION['id_user'];
		var_dump($id_user);
		
		if(new_exists($link, $title)){
			$message = "Такой файл уже есть, включите фантазию :)";
		}
		elseif($title == ''){
			$message = "Незаполнено название статьи :)";
		}
		elseif($content == ''){
			$message = "Незаполнено поле контент :)";
		}

		elseif(mb_strlen($content) > 1000){
			$message = "Статья превышает 1000 знаков! Будьте лаконичны ;)";
		}
		elseif(isset($_FILES['file'])){
			$check = can_upload($_FILES['file']);
		
			if($check === true){
				add_new($link, $title, $content, $id_user);
				// загружаем изображение на сервер
				echo 'Yes! Картинка успешно добавлена!';
				make_upload($_FILES['file'], $link, $title);
				echo "<meta http-equiv='refresh' content='2;url=../index.php'>";
				exit();
			}
			else{
				// выводим сообщение об ошибке
				$message = "<strong>$check</strong>";  
				}
		}		
	}
	else{
		$message = '';
		$title = '';
		$content = '';
	}
include '../v/v_add.php';
