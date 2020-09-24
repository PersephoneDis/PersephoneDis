<!DOCTYPE html>
<html lang ="ru">
<head>
	<?php
	$website_title = 'Заявки';
	require 'templates/head.php';


	?>
</head>
<body>
<?php require 'templates/header.php' ?>
<main class="container mt-5">
	<div class="row">
		<div class="col-md-8 mb-3">
			<?php
			require_once'mysql_connect.php';
			$sql = "SELECT * FROM requests ORDER BY date DESC";

		if($_COOKIE['log']!='') {
			echo "<a class='btn btn-info mt-5' href='?filter=Date'>По дате</a>";
			echo "<a class='btn btn-info mt-5' href='?filter=NoAddress'>Нет адреса</a>";
		}
		if ($_GET["filter"]=="Date") {
		$sql = "SELECT * FROM requests ORDER BY date";}
		if ($_GET["filter"]=="NoAddress") {
		$sql = "SELECT * FROM requests WHERE length(address)=0";}

				$query = $pdo->query($sql);
				while ($row = $query->fetch(PDO::FETCH_OBJ)) {
					echo "<h2>$row->name</h2>
					<p>$row->intro</p>
					<p><b>Автор заявки:</b> <mark>$row->email</mark></p>
					<a href='requests.php?id=$row->id' title='$row->title'>
					<button class='btn btn-warning mb-5'>Читать далее</button>
					</a>";}?>
		</div>
	</div>
</main>

</body>
</html>