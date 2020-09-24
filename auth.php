<!DOCTYPE html>
<html lang ="ru">
<head>
	<?php
	$website_title = 'Авторизация на сайте';
	require 'templates/head.php';
	?>
</head>
<body>

<?php require 'templates/header.php' ?>

<main class="container mt-5">
	<div class="row">
		<div class="col-md-8 mb-3">

			<?php
			if($_COOKIE['log']==''):

			?>

			<h4>Форма авторизации</h4>
			<form method="post">

				<label for="login">Ваш логин</label>
				<input type="text" name="login" id="login" class="form-control">

				<label for="pass">Ваш пароль</label>
				<input type="tepasswordxt" name="pass" id="pass" class="form-control">

				<div class="alert alert-danger mt-2" id="errorBlock"></div>
				<button type="button" id="auth_user" class="btn btn-success mt-5">Войти</button>
			</form>
			<?php
				else:
			?>

			<h2><?=$_COOKIE['log']?></h2>
			<button class ="btn btn-danger" id="exit_btn">Выйти</button>
			<?php
				endif;
			?>

		</div>

	</div>
</main>
<script src="jquery.min.js"></script>

<script>

$('#exit_btn').click(function () {

		$.ajax({
			url:'reg/exit.php',
			type: 'POST',
			cache: false,
			data: {},
			dataType:'html',
			success: function(data) {
				document.location.reload(true);
				}
		});
		});

	$('#auth_user').click(function () {

		var login = $('#login').val();
		var pass = $('#pass').val();

		$.ajax({
			url:'reg/auth.php',
			type: 'POST',
			cache: false,
			data: {'login' : login, 'pass' : pass},
			dataType:'html',
			success: function(data) {
				if(data=='Готово'){
					$('#auth_user').text('Готово');
					$('#errorBlock').hide();
					document.location.reload(true);
				}
				else {
					$('#errorBlock').show();
					$('#errorBlock').text(data);
				}
			}
		});
		});



</script>

</body>
</html>


