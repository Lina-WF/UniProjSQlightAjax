<!DOCTYPE html>
<html>
	<head>
  		<title>ГК Юрист и Недвижимость</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="img/icon.jpg" type="image/jpg">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="header flex_container color1">
			<div class="header_inner center logo_container">
				<div class="logo center">
					<a href="index.php"><img src="img/logo.jpg"></a>
				</div>
			</div>
			<div class="header_inner_contacts center padding15">
				<h1 class="header_inner_title">Настройки</h1>
			</div>
		</div>
		<div class="breadcrumbs_inner color3">
			<a class="dark" href="index.php">Главная</a> / Выбор профиля
		</div>
		<div class="main_inner">
			<form action="admin_edit.php" method="post">
				<div class="radio-group">
					<?php
						include "php/bd.php";
						include "php/take_ip.php";
					
						$query = "SELECT * FROM users WHERE ip IS NOT NULL";
						$rez = mysqli_query($db, $query);
						$mas = mysqli_fetch_array($rez);
						if ($value != $mas['ip'])
						{
							header('Location: admin_panel_login.php');
						}	
							
						
						$query = "SELECT * FROM content_headers";
						$rez = mysqli_query($db, $query);
						$i = true;
						$id = 0;
						while ($mas = mysqli_fetch_array($rez))
						{
							echo "<input type='radio' id='{$mas['id']}' name='header' class='radio-input' value='{$mas['id']}'";
							if ($i)
							{
								echo "checked";
								$i = false;
							}
							echo "/>
								<label for='{$mas['id']}' class='radio-label'>
									<span class='radio-inner-circle'></span>
									{$mas['header']}
								</label>";
						}
					?>
				</div>
				<div><button type='submit' class="all_corners">Далее</button></div>
				</form>
				<br>
				<div class="center button_container flex_container">
					<div><button type='button' class="left_corners" onclick="location.href='index.php'">На главную</button></div>
					<form action="admin_select.php" method="post">
						<input type="hidden" name="logout" value="true" />
						<div><button type='submit' class="right_corners">Выйти</button></div>
					</form>
					<?php 
						if (isset($_POST['logout']))
						{
							if ($_POST["logout"] == "true")
							{
								$query = "UPDATE users SET ip=NULL WHERE ip IS NOT NULL";
								$rez = mysqli_query($db, $query);
								header('Location: admin_panel_login.php');
							}
						}
					?>
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