<!DOCTYPE html>
<html lang ="ru">
<head>
	<?php

	require_once'mysql_connect.php';

	$sql = "SELECT * FROM requests WHERE id = :id";
	$id = isset($_GET['red_id'])?$_GET['red_id']: $_GET['id'];
	$query = $pdo->prepare($sql);
	$query->execute(['id'=> $id]);

	$request = $query->fetch(PDO::FETCH_OBJ);

	$website_title = 'Просмотр заявки';
	require 'templates/head.php';

	?>

</head>
<body>

<?php require 'templates/header.php' ?>

<main class="container mt-5">
	<div class="row">
		<div class="col-md-8 mb-3">
			<div class="jumbotron">
				<p><b>Автор заявки:</b> <mark><?=$request->name?></mark></p>
				<?php
					$date = date('d ',$request->date);
					$array = ['Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря'];
					$date .= $array[date('n',$request->date)-1];
					$date .= date(' Y H:i',$request->date);
				 ?>
				 <p><b>Дата обращения:</b> <u><?=$date?></u></p>
				<form action='' method='post'>
    <table>
      <tr>
        <td>Имя:</td>
        <td><input type='text' name='Name' id ='name' value='<?=$request->name?>'></td>
      </tr>
      <tr>
        <td>Email:</td>
        <td><input type='text' name='Email' id ='email' value='<?=$request->email?>'></td>
      </tr>
      <tr>
        <td>Телефон:</td>
        <td><input type='text' name='Phone' id ='phone' value='<?=$request->phone?>'></td>
      </tr>
      <tr>
        <td>Адрес:</td>
        <td><input type='text' name='Address' id ='address' value='<?=$request->address?>'></td>
      </tr>
      <tr>
        <td>Сообщение:</td>
        <td><input type='text' name='Mess' id ='mess' value='<?=$request->mess?>'></td>
      </tr>
      <?php if (isset($_GET['red_id'])) {

  echo "<tr>
        <td colspan='2'><input type='submit' class='btn btn-success mt-5' value='OK'></td>
      </tr>"; } ?>
    </table>
  </form>

	<?php
		if($_COOKIE['log']!='') {
			echo "<a class='btn btn-success mt-5' href='?red_id={$request->id}'>Редактировать  заявку</a>";
			echo "<a class='btn btn-danger mt-5' href='?del_id={$request->id}'>Удалить заявку</a>";
		}
	?>
	<?php
  if (isset($_GET['del_id'])) {
    $sql = "DELETE FROM requests WHERE id = :id";
    $query = $pdo->prepare($sql);
	$query->execute(['id'=> $_GET['del_id']]);
    if ($sql) {
      echo "<p>Заявка удалена.</p>";
    }
  }
  if (isset($_GET['red_id'])) {
  	$sql = "UPDATE requests SET name = :name,email = :email,phone = :phone, address = :address,mess = :mess WHERE id={$_GET['red_id']}";
	$query = $pdo->prepare($sql);
	$query->execute(['name'=> $_POST['Name'],'email'=> $_POST['Email'],'phone'=> $_POST['Phone'],'address'=> $_POST['Address'],'mess'=> $_POST['Mess']]);
  }
  ?>
			</div>
		</div>
	</div>
</main>
</body>
</html>