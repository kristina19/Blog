<!doctype html>
<html>
<head>
    <title></title>
	<link rel="stylesheet" href="../v/style.css">
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		Название статьи<br>
		<input type="text" name="title" value="<?php echo $title?>"><br>
		Содержимое статьи<br>
		<textarea name="content"><?php echo $content?></textarea><br>
		<input type="submit" value="Сохранить"><br><br><br>
		<input type="file" name="file"><br>
		<input type="submit" name="Load" value="Загрузить файл!"><br>
	</form>
	<p><?=$message?></p>
</body>
</html>	