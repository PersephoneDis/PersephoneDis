<?php
	$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
	$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
	$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
	$pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));


	$error = '';
	if (strlen($username) <= 3)
		$error = 'Имя должно быть > 3 символов';
	elseif (strlen($email) <= 3)
		$error = 'Email должен быть > 3 символов';
	elseif (strlen($login) <= 3)
		$error = 'Логин должен быть > 3 символов';
	elseif (strlen($pass) <= 8)
		$error = 'Пароль должен быть > 8 символов';

	if($error!='') {
			echo $error;
			exit();
		}


	$hash = "r6rdi8vhgBFhjk7";
	$pass = md5($pass . $hash);

	require_once'../mysql_connect.php';


	$sql = "INSERT INTO users (name, email, login, pass) VALUES (?,?,?,?)";
	$query = $pdo->prepare($sql);
	$query->execute([$username,$email,$login,$pass]);

echo 'Готово';
		?>