<?php
	$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
	$address = trim(filter_var($_POST['address'], FILTER_SANITIZE_STRING));
	$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
	$phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT));
	$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));


	$error = '';
	if (strlen($username) <= 3)
		$error = 'Имя должно быть > 3 символов';
	elseif (strlen($address) <= 3)
		$error = 'Адрес должен быть > 3 символов';
	elseif (strlen($email) <= 3)
		$error = 'Email должен быть > 3 символов';
	elseif (strlen($phone) != 11)
		$error = 'Телефон должен быть 11 цифр';
	elseif (strlen($mess) <= 3)
		$error = 'Сообщение должно быть > 3 символов';

	if($error!='') {
			echo $error;
			exit();
		}

		require_once'../mysql_connect.php';
		$sql = "INSERT INTO requests (name, address, email, phone, mess, date) VALUES (?,?,?,?,?,?)";
		$query = $pdo->prepare($sql);
		$query->execute([$username,$address,$email,$phone,$mess,time()]);

		echo 'Готово';
		?>