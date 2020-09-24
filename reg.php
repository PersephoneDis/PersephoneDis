<!DOCTYPE html>
<html lang ="ru">
<head>
	<?php
	$website_title = 'Регистрация на сайте';
	require 'templates/head.php';
	?>
</head>
<body>

<?php require 'templates/header.php' ?>

<main class="container mt-5">
	<div class="row">
		<div class="col-md-8 mb-3">

			<h4>Форма регистрации</h4>
			<form method="post">
				<label for="username">Ваше имя</label>
				<input type="text" name="username" id="username" class="form-control">

				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control">

				<label for="login">Ваш логин</label>
				<input type="text" name="login" id="login" class="form-control">

				<label for="pass">Ваш пароль</label>
				<input type="password" name="pass" id="pass" class="form-control">

				<div class="alert alert-danger mt-2" id="errorBlock"></div>

				<button type="button" id="reg_user" class="btn btn-success mt-5">Зарегистрироваться</button>
			</form>

		</div>

		<?php require 'templates/aside.php' ?>
	</div>
</main>
<?php require 'templates/footer.php' ?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="jquery.min.js"></script>

<script>
	$('#reg_user').click(function () {

		alert('user registred');

		var name = $('#username').val();
		var email = $('#email').val();
		var login = $('#login').val();
		var pass = $('#pass').val();

		$.ajax({
			url:'reg/reg.php',
			type: 'POST',
			cache: false,
			data: {'username' : name, 'email' : email, 'login' : login, 'pass' : pass},
			dataType:'html',
			success: function(data) {
				if(data=='Готово'){
					$('#reg_user').text('Готово');
					$('#errorBlock').hide();
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


