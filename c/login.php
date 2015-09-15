<?php
	session_start(); 
	
	include_once('config.php');

	if(count($_POST) > 0){
		if($_POST['login'] == LOGIN && $_POST['password'] == PASS){
			$_SESSION['is_auth'] = true;
			
			if(isset($_POST['remember'])){
				setcookie('login', md5($_POST['login']), time() + 3600 * 24 * 31, '/');
				setcookie('password', md5($_POST['password']), time() + 3600 * 24 * 31, '/');
			}	
			
			header('Location: index.php');
			exit();
		}
		else{
			$msg = 'Неверный логин или пароль';
		}
	}
	else{
		$msg = '';
	}
include 'v/v_login.php';