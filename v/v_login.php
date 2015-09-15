<!doctype html>
<html>
<head>
    <title>Наш блог</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Авторизация пользователя</h1>
	<form method="post">
		Логин<br>
		<input type="text" name="login"><br>
		Пароль<br>
		<input type="text" name="password"><br>
		<input type="checkbox" name="remember" checked>Запомнить меня
		<input type="submit" value="Войти">
		<p><?php echo $msg; ?></p>
	</form>
</body>
</html>	