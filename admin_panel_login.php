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
						$("button[data-status='error']").click(
							function()
							{
								$("div[data-status='error']").attr("style", "display:none;");
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
			<div class="header_inner_contacts center padding15">
				<h1 class="header_inner_title">Авторизация</h1>
			</div>
		</div>
		<div class="breadcrumbs_inner color3">
			<a class="dark" href="index.php">Главная</a> / Авторизация
		</div>
		<div class="main_inner">
			<div>
				<form action="admin_panel_login.php" method="post">
					<div class="input_container">
						<div>Введите логин:</div>
						<input type="text" placeholder="Логин" id="login" name="login" value="<?php if($_POST){echo $_POST["login"];}?>" required />
					</div>
					<div class="input_container">
						<div>Введите пароль:</div>
						<input type="password" placeholder="Пароль" id="password" name="password" required />
					</div>
					<button class="all_corners" type="submit">Войти</button><br><br>
				</form>
				
				<?php 
					include "php/bd.php";
					include "php/take_ip.php";
					
					$query = "SELECT * FROM users WHERE ip IS NOT NULL";
					$rez = mysqli_query($db, $query);
					$mas = mysqli_fetch_array($rez);
					if ($value == $mas['ip'])
					{
						header('Location: admin_select.php');
					}
					
					if ($_POST)
					{
						
						
						$query = "SELECT * FROM users";
						$rez = mysqli_query($db, $query);
						$i = true;
						while ($mas = mysqli_fetch_array($rez))
						{
							if ($_POST["login"] == $mas['login'] && password_verify($_POST['password'], $mas['password']))
							{
								$query_id = "UPDATE users SET ip='$value' WHERE id=".$mas['id'];
								$rez_id = mysqli_query($db, $query_id);
								$i = false;
								header('Location: admin_select.php');
							}
						}
						if ($i)
						{
							echo "<div data-status='error' class='box center flex_container'>
								<div> Неверный логин или пароль. Пожалуйста, повторите попытку.
								<br>
								<br>
								<button data-status='error' class='light'>Ок</button>
								</div>
							</div>";
						}
					}
				?>
				
			</div>
			<div class="center">
				<button class="all_corners" onclick="location.href='index.php'">На главную</button>
			</div>
		</div>
		<div class="footer center flex_container color3">
			<div class="footer_inner padding15 logo phone_hidden">
				<a href="index.php"><img src="img/logo.jpg"></a>
			</div> 
			<div class="footer_inner padding15">
				<div class="footer_inner_title bigger_text">Контакты тех.поддержки</div> 
				<div>
					<a class="dark" href="mailto:ushakova.l1na21@gmail.com">mail@mail.com</a><br>
					<a class="dark" href="tel:+79671202250">+00000000000</a>
				</div> 
			</div>  
		</div>
	</body>
</html>