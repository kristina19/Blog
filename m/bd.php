<?php
	//выполняет соединение, устанавливает кодировку,  
	//возвращает $link - если удалось соединиться
	function connect(){
		$link = mysqli_connect('localhost', 'root', '', 'newsblog');
		if(!$link)
			return false;
		mysqli_query($link, 'SET NAMES utf-8');
		return $link;
	}