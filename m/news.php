<?php
	function is_auth(){
		$is_auth = false;
		if($_SESSION['is_auth'])
			$is_auth = true;
		else{
			if($_COOKIE['login'] == md5(LOGIN) && $_COOKIE['password'] == md5(PASS))
				$is_auth = true;
		}
	return $is_auth;
	}
	
	function can_upload($file){
		$title = $file['name'];
		$white_list = array('jpg', 'png', 'jpeg', 'gif', 'img', 'bmp');
		$getMime = explode('.', $file['name']);
		$Mime = strtolower($getMime[count($getMime) - 1]);
		if($file['size'] > 2 * 1024 * 1024) 
			return 'Файл превышает 2 МБ, попробуйте уменьшить размер файла на https://tinypng.com/';
			if($file['size'] == 0) 
				return 'Картинка не выбрана. Проверьте ;)';
			if($file['name'] == '')
				return 'Картинка не выбрана, попоробуйте снова :)';
			if(!in_array($Mime, $white_list))
				return 'Недопустимый тип файла! Принимаем только картинки ;)';
			if(file_exists("img/$title"))
				return "Такая картинка уже есть, включите фантазию :)";
	return true;
	}
			
	function make_upload($file, $link, $name){
		$res = mysqli_query($link, "SELECT id_new FROM news WHERE name='$name'");
		$title = mysqli_fetch_assoc($res);
		$title = $title['id_new'];
		$getMime = explode('.', $file['name']);
		$Mime = strtolower($getMime[count($getMime) - 1]);
		copy($file['tmp_name'], "../image/$title.$Mime");
	}
	
	function get_messages($link){	
		$res = mysqli_query($link, "SELECT * FROM news ORDER BY publication_date DESC");
		$messages = array();
		while($row = mysqli_fetch_assoc($res)){
			$messages[] = $row;	
		}
	return $messages;
	}
	
	function get_content($link, $id){
		$res = mysqli_query($link, "SELECT content FROM news WHERE id_new='$id'");
		$content = mysqli_fetch_assoc($res);
	return $content;
	}
	
	function add_new($link, $name, $content, $id_user){	
		$name = trim($name);
		$content = trim($content);
		if($name == '' || $content == '')
			return false;
		mysqli_query($link, "INSERT INTO news (id_user, name, content) VALUES ('$id_user', '$name', '$content')");
		if (mysqli_connect_errno()){
			echo ("Не удалось подключиться: " . mysqli_connect_error());
			exit();
		}
	return true;
	}

	function update_new($link, $id, $content, $name){	
		$name = trim($name);
		$content = trim($content);
		if($name == '' || $content == '')
			return false;
		mysqli_query($link, "UPDATE `news` SET `content` = '$content', `name` = '$name' WHERE `id_new` = '$id'");
		if (mysqli_connect_errno()){
			echo ("Не удалось подключиться: " . mysqli_connect_error());
			exit();
		}
	return true;
	}
	
	function delete_new($link, $id){	
		if($id == '')
			return false;
		mysqli_query($link, "DELETE FROM `news` WHERE id_new='$id'");
		if (mysqli_connect_errno()){
			echo ("Не удалось подключиться: " . mysqli_connect_error());
			exit();
		}
	return true;
	}

	function new_exists($link, $id){
		$res = mysqli_query($link, "SELECT * FROM news WHERE id_new='$id'");
		$new = mysqli_fetch_assoc($res);
		if (empty($new))
			return false;
		if (mysqli_connect_errno()){
			echo ("Не удалось подключиться: " . mysqli_connect_error());
			exit();
		}
	return true;
	}
	
	function check_auth($link, $login, $password){
		$res = mysqli_query($link, "SELECT id_user FROM `users` WHERE `login`= '$login' AND `password` = '$password'");
		$id_user = mysqli_fetch_assoc($res);
		$id_user = $id_user['id_user'];
		if (empty($id_user))
			return false;
		if (mysqli_connect_errno()){
			echo ("Не удалось подключиться: " . mysqli_connect_error());
			exit();
		}
	return $id_user;
	}
	
	function get_fullmessages($link){	
		$res = mysqli_query($link, "SELECT * FROM `news` LEFT JOIN `users` using(id_user)");
		$fullmessages = array();
		while($row = mysqli_fetch_assoc($res)){
			$fullmessages[] = $row;	
		}
	return $fullmessages;
	}