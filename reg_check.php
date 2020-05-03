<!DOCTYPE html>
<html>
<?php include 'header.php' ?>
<?php
	$conn = establish_connection();
	$reg_name = $_POST['user_name'];
	$reg_passwd = $_POST['password1'];
	$reg_repeat = $_POST['password2'];

	if($reg_passwd != $reg_repeat)
	{
		print_message("Warning!", "两次输入的密码不一致！", "warning");
		?>
		</div>
		<div class="row justify-content-center mb-4">
			<a href="reg.php"><button type="button" class="btn btn-primary"> 返回注册 </button></a>
		</div>
		<?
		exit();
	}

	$reg_time = date("Y-m-d H:i:s");
	$sql_command_qname = "SELECT * FROM users WHERE name='$reg_name'";
	$result = mysqli_fetch_array(mysqli_query($conn, $sql_command_qname));
	if($result[0])
	{
		print_message("Warning!", "该用户已被注册", "warning");
		?>
		<div class="row justify-content-center mb-4">
			<a href="reg.php"><button type="button" class="btn btn-primary"> 返回注册 </button></a>
		</div>
		<?
	}
	else
	{
		$result = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(id) FROM users"));
		$id_max = $result[0]+1;
		$sql_command_insert = "INSERT INTO users (id, password, name, money, reg_time, confirmed) VALUES
			($id_max, '$reg_passwd', '$reg_name', 0, '$reg_time', 0)";
		mysqli_query($conn, $sql_command_insert);
		print_message("Success!", "注册成功，请等待审核", "success");
		?>
		</div>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?

	}
?>
<?php include 'footer.php' ?>
