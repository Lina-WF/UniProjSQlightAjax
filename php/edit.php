<?php
include "bd.php";

if ($_POST)
{
	$do = $_POST["do"];
	
	if ($do == "edit")
	{
		$query = "SELECT * FROM content WHERE id = {$_POST['id']}";
		$rez = mysqli_query($db, $query);	
		$response;				
		while ($mas = mysqli_fetch_array($rez))
		{
			$response = ["do" => $do,
						"id" => $_POST['id'],
						"prev" => $mas["content"],
						"new" => $_POST['content']];
		}
		
		$query = "UPDATE content SET content='{$_POST['content']}' WHERE id={$_POST['id']}";
		$rez = mysqli_query($db, $query);
		
		echo json_encode($response);
	}
	else if ($do == "del")
	{
		$query = "SELECT * FROM content WHERE id = {$_POST['id']}";
		$rez = mysqli_query($db, $query);	
		$response;				
		while ($mas = mysqli_fetch_array($rez))
		{
			$response = ["do" => $do,
						"id" => $_POST['id'],
						"prev" => $mas["content"],
						"new" => null];
		}
		
		$query = "DELETE FROM content WHERE id={$_POST['id']}";
		$rez = mysqli_query($db, $query);
		
		echo json_encode($response);
	}
	else if ($do == "add")
	{
		$query = "INSERT INTO content(content, header_id) VALUES('{$_POST['content']}', '{$_POST['header_id']}')";
		$rez = mysqli_query($db, $query);
		
		$query = "SELECT * FROM content ORDER BY id DESC LIMIT 1";
		$rez = mysqli_query($db, $query);	
		$response;				
		while ($mas = mysqli_fetch_array($rez))
		{
			$response = ["do" => $do,
					"id" => $mas["id"],
					"prev" => null,
					"new" => $_POST['content']];
		}
		
		echo json_encode($response);
	}
}