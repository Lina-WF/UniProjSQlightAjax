<!DOCTYPE html>
<html>
	<head>
  		<title>ГК Юрист и Недвижимость</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="img/icon.jpg" type="image/jpg">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="js/jquery-3.7.1.min.js"></script>
		<script>
			$(document).ready(function() {
				$("body").on("click", "button[name='edit']", function(e){
					if ($("textarea[data-id='" + $(this).attr("data-id") + "']").val() == "") {
						$("textarea[data-id='" + $(this).attr("data-id") + "']").attr('style', 'border-color: red');
					}
					else
					{
						$("textarea[data-id='" + $(this).attr("data-id") + "']").removeAttr('style');
						$("input[type='hidden'][data-id='" + $(this).attr("data-id") + "']").attr('value', 'edit');
						$("form[data-id='" + $(this).attr("data-id") + "']").submit();
					}
				});
				
				$("body").on("click", "button[name='del']", function(e){
					$("input[type='hidden'][data-id='" + $(this).attr("data-id") + "']").attr('value', 'del');
					$("div[data-status='del']").removeAttr("style");
				});
				
				$("button[name='add']").click(
						function()
						{
							if ($("textarea[data-id='add']").val() == "") {
							$("textarea[data-id='add']").attr('style', 'border-color: red');
							}
							else
							{
								$("textarea[data-id='add']").removeAttr('style');
								$("form[data-id='add']").submit();
							}
						}
					);
				
				$("button[data-dialog='dialog']").click(
						function()
						{
							$("div[data-status='success']").attr("style", "display:none");
						}
					);
					
				$("button[data-dialog='yes']").click(
						function()
						{
							var id = $("input[type='hidden'][value='del']").attr("data-id");
							$("form[data-id='" + id + "']").submit();
							$("div[data-status='del']").attr("style", "display:none");
						}
					);
				
				$("body").on("submit", "form[action='php/edit.php']", function(e){
					e.preventDefault();
                    
                    var formData = $(this).serialize();
					var id = $(this).attr("data-id");
                    
					
					
                    $.ajax({
                        type: 'POST',
                        url: 'php/edit.php',
                        data: formData,
						dataType: 'json',
                        success: function(response) {
							$("div[data-status='success']").removeAttr("style");
							if (response["do"] == "del")
							{
								$("p[data-do='true']").text("Удаление прошло успешно! Был удалён элемент с id = " + response["id"] + ".");
								$("td[data-ver='prev']").text(response["prev"]);
								$("td[data-ver='new']").text("");
								$("td[data-ver='arrow']").text("");
								$("li[data-id='" + response["id"] + "']").remove();
							}
							else if (response["do"] == "edit")
							{
								console.log(response);
								$("p[data-do='true']").text("Изменение прошло успешно! Был изменён элемент с id = " + response["id"] + ".");
								$("td[data-ver='prev']").text(response["prev"]);
								$("td[data-ver='new']").text(response["new"]);
								$("td[data-ver='arrow']").text("->");
								$("td[data-id='" + response["id"] + "'][data-type='edited']").text("Предыдущая версия: " + response["prev"]);
							}
							else if (response["do"] == "add")
							{
								$("p[data-do='true']").text("Добавление прошло успешно! Был добавлен элемент с id = " + response["id"] + ".");
								$("td[data-ver='prev']").text("");
								$("td[data-ver='new']").text(response["new"]);
								$("td[data-ver='arrow']").text("");
								$("textarea[data-id='add']").val('');
								$("ol[data-input='true']").append("<li data-id='" + response["id"] + "']}><form action='php/edit.php' method='post' data-id='" + response["id"] + "'><table><tr><td><textarea name='content'  data-id='" + response["id"] + "'>" + response["new"] + "</textarea></td><td class='edit_button'><button name='edit' data-id='" + response["id"] + "' type='button' class='all_corners'>Изменить</button></td><td class='edit_button'><button name='del' data-id='" + response["id"] + "' type='button' class='all_corners'>Удалить</button></td><td><input type='hidden' name='id' value='" + response["id"] + "'><input type='hidden' name='do' data-id='" + response["id"] + "'></td></tr><tr><td colspan=4 data-type='edited' data-id='" + response["id"] + "'></td></td></table></form></li>");
							}
                        },
                        error: function(error) {
                            $("div[data-status='error']").removeAttr("style");
                        }
                    });
				});
            });
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
				<h1 class="header_inner_title">Настройки</h1>
			</div>
		</div>
		<div class="breadcrumbs_inner color3">
			<a class="dark" href="index.php">Главная</a> / <a class="dark" href="admin_select.php">Выбор профиля</a> / Изменить
		</div>
		<div class="main_inner">
			<ol data-input="true" class="list">
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
					
					if ($_POST["header"])
					{
						$id = $_POST["header"];
						$query = "SELECT * FROM content WHERE header_id = $id";
						$rez = mysqli_query($db, $query);	
						
						while ($mas = mysqli_fetch_array($rez))
						{
							echo "<li data-id='{$mas['id']}'><form action='php/edit.php' method='post' data-id='{$mas['id']}'>
									<table>
										<tr>
											<td>
												<textarea name='content' data-id='{$mas['id']}' >{$mas['content']}</textarea>
											</td>
											<td class='edit_button'>
												<button name='edit' data-id='{$mas['id']}' type='button' class='all_corners'>Изменить</button>
											</td>
											<td class='edit_button'>
												<button name='del' data-id='{$mas['id']}' type='button' class='all_corners'>Удалить</button>
											</td>
											<td>
												<input type='hidden' name='id' value='{$mas['id']}'>
												<input type='hidden' name='do' data-id='{$mas['id']}'>
											</td>
										</tr>
										<tr><td colspan=4 data-type='edited' data-id='{$mas['id']}'></td></td>
									</table>
								</form></li>";
						}
					}
					else
					{
						header('Location: admin_select.php');
					}
					
				?>
				</ol>
				<ol class="list">
				<li>
					<form action='php/edit.php' data-id="add" method='post'>
						<table>
							<tr>
								<td>
									<textarea name='content' data-id="add" placeholder="Введите новую услугу"></textarea>
								</td>
								<td class='edit_button'>
									<button name='add' type='button' class='all_corners'>Добавить</button>
								</td>
								<td>
									<input type='hidden' name='header_id' value='<?php echo $id; ?>'>
									<input type='hidden' name='do' value='add'>
								</td>
							</tr>
						</table>
					</form>
				</li>
			</ol>
			<div data-status="success" class="box center flex_container" style="display:none;">
				<div> 
				<p data-do="true"></p>
				<table><tr>
				<td data-ver="prev"></td>
				<td data-ver="arrow"></td>
				<td data-ver="new"></td>
				</tr></table>
				<br>
				<br>
				<button data-dialog="dialog" data-status="success" class="light">Ок</button>
				</div>
			</div>
			<div data-status="error" class="box center flex_container" style="display:none;">
				<div> Что-то пошло не так. Пожалуйста, повторите позже или напишите в тех.поддержку.
				<br>
				<br>
				<button data-dialog="dialog" data-status="error" class="light">Ок</button>
				</div>
			</div>
			<div data-status="del" class="box center flex_container" style="display:none;">
				<div> Вы уверены, что хотите удалить этот элемент?
				<br>
				<br>
				<button data-dialog="yes" data-status="del" class="light">Да</button>
				<button data-dialog="dialog" data-status="del" class="light">Нет</button>
				</div>
			</div>
			<div class="center button_container flex_container">
					<div><button type='button' class="left_corners" onclick="location.href='admin_select.php'">Выбрать профиль</button></div>
					<div><button type='button' onclick="location.href='index.php'">На главную</button></div>
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