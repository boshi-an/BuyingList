<!DOCTYPE html>
<html>
<?php include 'header.php' ?>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "AnBS392854382";
	$dbname = "my_database";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	mysqli_query($conn, "SET NAMES UTF8");
	$reg_name = $_POST['user_name'];
	$reg_passwd = $_POST['password1'];
	$reg_repeat = $_POST['password2'];

	if($reg_passwd != $reg_repeat)
	{
		?>
		<div class="row justify-content-center mt-6">
			<div class="col-lg-6">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
				<span class="alert-inner--text"><strong>Warning!</strong> 两次输入的密码不一致！</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				</div>
			</div>
			</br>
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
		?>
		<div class="row justify-content-center mt-6">
			<div class="col-lg-6">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
				<span class="alert-inner--text"><strong>Warning!</strong> 该用户已被注册！</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				</div>
			</div>
			</br>
		</div>
		<div class="row justify-content-center mb-4">
			<a href="reg.php"><button type="button" class="btn btn-primary"> 返回注册 </button></a>
		</div>
		<?
	}
	else
	{
		$result = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(id) FROM users"));
		$id_max = $result[0]+1;
		$sql_command_insert = "INSERT INTO users (id, password, name, money, reg_time) VALUES
			($id_max, '$reg_passwd', '$reg_name', 0, '$reg_time')";
		mysqli_query($conn, $sql_command_insert);

		?>
		<div class="row justify-content-center mt-6">
			<div class="col-lg-6">
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
					<span class="alert-inner--text"><strong>Success!</strong> 注册成功!</span>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?

	}
?>
<?php include 'footer.php' ?>
