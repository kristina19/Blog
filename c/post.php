<?php
	include '../m/bd.php';
	include '../m/news.php';
	
	$link = connect();
	
	$id = $_GET['id'];
		
/* 		echo '<pre>';
		print_r($_GET);
		echo '</pre>';
		var_dump($id);
*/
		 
	if($id != ''){
		$content = get_content($link, $id);
		$content = $content['content'];
	}
	else
		$content = 'Ошибка 404 - такой статьи нет!';
include '../v/v_post.php';