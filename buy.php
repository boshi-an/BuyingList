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
	$qname = $_POST['user_name'];
	$qpasswd = $_POST['password'];
	$qproduct_name = $_POST['custom_drink_type'];
	$qproduct_temp = $_POST['custom_drink_temperature'];
	$qproduct_addition = $_POST['addition'];
	$qrequest_time = date("Y-m-d H:i:s");
	print_r($qproduct_name);
	print_r($qproduct_temp);
	print_r($qproduct_addition);
	$sql_command_quser = "SELECT name, password, id FROM users WHERE name='$qname'";
	$buyer = mysqli_fetch_array(mysqli_query($conn, $sql_command_quser));
	if(empty($buyer))
	{
		?>
		<div class="row justify-content-center mt-6">
			<div class="col-lg-6">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
				<span class="alert-inner--text"><strong>Warning!</strong> 没有这个用户！</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				</div>
			</div>
			</br>
		</div>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?
		exit();
	}
	else if($buyer['password'] != $qpasswd)
	{
		?>
		<div class="row justify-content-center mt-6">
			<div class="col-lg-6">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
				<span class="alert-inner--text"><strong>Warning!</strong> 密码错误！</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				</div>
			</div>
			</br>
		</div>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?
		exit();
	}
	else
	{
		exit();
		$last_request = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(id) FROM requests"));
		$id_max = $last_request[0]+1;
		$buyer_id = $buyer['id'];
		$buyer_name = $buyer['name'];
		$sql_command_insert = "INSERT INTO requests (request_id, user_id, product_name, product_temperature, product_addition, request_time, user_name) VALUES
			($id_max, $buye_id, '$qproduct_name', '$qproduct_temp', '$qproduct_addition', '$qrequest_time', 'buyer_name')";
		print_r($sql_command_insert);
		mysqli_query($conn, $sql_command_insert);
	}
?>
<?php include 'footer.php' ?>
