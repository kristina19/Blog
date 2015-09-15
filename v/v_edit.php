<!doctype html>
<html>
<head>
    <title></title>
	<link rel="stylesheet" href="../v/style.css">
</head>
<body>
	<form method="post">
		<p>Название файла</p>
		<input type="text" name="title" value="<?php echo $title?>"><br>
		<p>Содержимое файла</p>
		<textarea name="content"><?php echo $content?></textarea><br>
		<input type="reset" name="Clear" value="Очистить введенное"><br>
		<input type="submit" name="Delete" value="Удалить" onclick="if(!confirm('Вы точно хотите удалить эту статью?'))return false;">
		<input type="submit" name="Save" value="Сохранить" onclick="if(!confirm('Вы точно хотите перезаписать эту статью?'))return false;"><br>
	</form>
	<p><?=$message?></p>
</body>
</html>	