<!doctype html>
<html>
<head>
    <title>Наш блог</title>
	<link rel="stylesheet" href="v/style.css">
</head>
<body>
	<h1>Статьи нашего блога</h1>
	<div>
		<?php 
			$is_auth = is_auth();
			foreach($messages as $id): ?>
				<div>
					<strong><?=$id['name']?></strong><br><br>
					<?="<a href=c/post.php?id={$id['id_new']}>Просмотр</a>";
					if($is_auth){
						echo "<a href=c/edit.php?id={$id['id_new']}>Редактирование</a>";
						echo "<a href=c/edit.php?id={$id['id_new']}>Удалить</a>";
					}
					echo '<hr><br>'; ?>
				</div>
			<? endforeach; ?>
	</div>			
	<form method="post">
		<input type="submit" name="add" value="Добавлю новую статью!"><br>	
	</form>
</body>
</html>	