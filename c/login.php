<?php
	include '../m/bd.php';
	include '../m/news.php';
	session_start(); 
	
	$link = connect();
	
	if (!$link){
		echo ("Не удалось подключиться: " . mysqli_connect_error());
		exit();
	}

	if(count($_POST) > 0){
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);
		
		if($login == ''){
			$message = "Незаполнено поле Login";
		}
		elseif($password == ''){
			$message = "Незаполнено поле Password";
		}
		else {
			$id_user = check_auth($link, $login, $password);
			if($id_user !== false){
				$_SESSION['is_auth'] = true;
				$_SESSION['id_user'] = $id_user;
				
				if(isset($_POST['remember'])){
					setcookie('login', md5($_POST['login']), time() + 3600 * 24 * 31, '/');
					setcookie('password', md5($_POST['password']), time() + 3600 * 24 * 31, '/');
				}	
				
				header('Location: ../index.php');
				exit();
			}
			else{
				$message = 'Неверный логин или пароль';
			}
		}		
	}
	else{
		$message = '';
		$login = '';
		$password = '';
	}
include '../v/v_login.php';