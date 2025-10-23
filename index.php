<!DOCTYPE html>
<html>
	<head>
  		<title>ГК Юрист и Недвижимость</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="img/icon.jpg" type="image/jpg">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-3.7.1.min.js"></script>
		<script>
			$(document).ready(
				function()
				{
					$(".profile_header").click(
						function()
						{
							window.location.href = $(this).attr("name") + '.php';
						}
					);
				}
			);
		</script>
 	</head>
	<body>
		<div class="header flex_container color1">
			<div class="header_inner center logo_container">
				<div class="logo center">
					<a href="index.php"><img src="img/logo.jpg"></a>
				</div>
			</div>
			<div class="header_inner padding15 phone_hidden">
				<h1 class="header_inner_title">ГК Юрист и Недвижимость</h1>
				<div class="header_inner_text">Юридические услуги обширного профиля</div>
			</div>
			<div class="header_inner padding15 center header_inner_text">
				<a href="tel:+79671202250">+79256926062</a><br>
				<a href="tel:+79671202250">+79207919963</a><br>
				<div class="phone_hidden">
					или<br><br>
					<button class="all_corners light" onclick="location.href='contacts.html'">Заказать звонок</button>
				</div>
			</div>
		</div>
		<div class="breadcrumbs_inner color3">
			Главная / 
		</div>
		<div class="main_inner">
		
		<?php
		include "php/bd.php";
		
		$query = "SELECT * FROM content_headers";
		$rez = mysqli_query($db, $query);
		while ($mas = mysqli_fetch_array($rez))
		{
			echo "
			<div class='profile_container flex_container'>
				<div class='left_corners profile_header color2' name='{$mas['file']}'>
					{$mas['header']}
				</div>
				<div class='profile_information padding15' name='{$mas['file']}'>
					{$mas['describtion']}
				</div>
			</div>
			";
		}
		?>
			<div>
				<div>
					Для получения полной стоимости юридических услуг и анализа ситуации необходимо ознакомиться 
					с первичной документацией и проблематикой в целом. Работа осуществляется на основании соглашения 
					Клиента и адвоката/юридической фирмы. 
				</div>
				<br>
				<div class="highlight_box color1">
					<div class="highlight center">
						Звоните, пишите будем рады Вам помочь, первичная консультация - <span class="bigger_text">бесплатно</span>!
						<br><br>
						<div class="center"><button class="all_corners light" onclick="location.href='contacts.html'">Позвоните мне!</button></div> 
					</div>
				</div>
				<br>
				<div class="bigger_text center">
					Любая проблема решаема!!!
				</div>
			</div>
		</div>
		<?php include "footer.html"; ?>
	</body>
</html>