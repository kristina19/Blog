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
			$is_admin = is_admin($link);
			foreach($fullmessages as $id): ?>
				<div>
					Статья: "<strong><?=$id['name']?></strong>"  Автор: <?=$id['login']?><br><br>
					<?="<a href=c/post.php?id={$id['id_new']}>Просмотр</a>";
					if($is_auth){
						if($is_admin){
							echo "<a href=c/edit.php?id={$id['id_new']}>Редактирование</a>";
							echo "<a href=c/edit.php?id={$id['id_new']}>Удалить</a>";
						}
						else for($i=0;$i<1;$i++){
								if($messagesById[$i]['id_user']==$id['id_user']){
									echo "<a href=c/edit.php?id={$id['id_new']}>Редактирование</a>";
									echo "<a href=c/edit.php?id={$id['id_new']}>Удалить</a>";
								}
						}
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