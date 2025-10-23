<!DOCTYPE html>
<html>
	<head>
  		<title>ГК Юрист и Недвижимость</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="img/icon.jpg" type="image/jpg">
		<meta name="viewport" content="width=device-width, initial-scale=1">
 	</head>
	<body>
		<?php $title = "Проблемы воинской <br> службы/мобилизации и СВО"; 
			include "header.php";
		?>
		<div class="breadcrumbs_inner color3">
			<a class="dark" href="index.php">Главная</a> / Проблемы воинской службы/мобилизации и СВО
		</div>
		<div class="main_inner">
			<ol class="list">
				<?php 
					include "php/bd.php";
					$id = 3;
					
					$query = "SELECT * FROM content WHERE header_id = $id";
					$rez = mysqli_query($db, $query);
					while ($mas = mysqli_fetch_array($rez))
					{
						echo "<li>{$mas['content']}</li>";
					}
				?>
			</ol>
			<br>
			<div class="center button_container flex_container">
				<div><button class="left_corners" onclick="location.href='index.php'">На главную</button></div>
				<div><button class="right_corners" onclick="location.href='contacts.html'">Связаться</button></div>
			</div>
		</div>
		<?php include "footer.html"; ?>
	</body>
</html>