<!DOCTYPE html>
<html lang ="ru">
<head>
	<?php
	$website_title = 'Оставить заявку';
	require 'templates/head.php';
	?>
</head>
<body>

<?php require 'templates/header.php' ?>

<main class="container mt-5">
	<div class="row">
		<div class="col-md-8 mb-3">

			<h4>Обратная связь</h4>
			<form method="post">
				<label for="username">ФИО</label>
				<input type="text" name="username" id="username" class="form-control">
				<label for="address">Адрес</label>
				<input type="text" name="address" id="address" class="form-control">

				<label for="email">Email</label>
				<input type="email" name="email" id="email" class="form-control">
				<label for="phone">Телефон</label>
				<input type="tel" name="phone" id="phone"  class="form-control">

				<label for="mess">Текст заявки</label>
				<textarea name="mess" id="mess" class="form-control"></textarea>

				<div class="alert alert-danger mt-2" id="errorBlock"></div>

				<button type="button" id="send_mess" class="btn btn-success mt-5">Отправить сообщение</button>
			</form>

		</div>
	</div>
</main>

<script src="jquery.min.js"></script>

<script>
	$('#send_mess').click(function () {
		var name = $('#username').val();
		var address = $('#address').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var mess = $('#mess').val();

		$.ajax({
			url:'reg/mail.php',
			type: 'POST',
			cache: false,
			data: {'username' : name,'address' : address, 'email' : email, 'phone' : phone, 'mess' : mess},
			dataType:'html',
			success: function(data) {
				if(data=='Готово'){
					$('#send_mess').text('Готово');
					$('#errorBlock').hide();
					$('#username').val('');
					$('#address').val('');
					$('#email').val('');
					$('#phone').val('');
					$('#mess').val('');
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


