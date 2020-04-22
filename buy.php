<!DOCTYPE html>
<html>
<?php include 'header.php' ?>

<?php
	$conn = establish_connection();
	$qname = $_POST['user_name'];
	$qpasswd = $_POST['password'];
	$qproduct_name = $_POST['custom_drink_type'];
	$qproduct_temp = $_POST['custom_drink_temperature'];
	$qproduct_addition = $_POST['addition'];
	$qrequest_time = date("Y-m-d H:i:s");
	$sql_command_quser = "SELECT name, password, id FROM users WHERE name='$qname'";
	$buyer = mysqli_fetch_array(mysqli_query($conn, $sql_command_quser));
	if(empty($buyer))
	{
		print_message("Warning!", "没有这个用户!", "warning");
		?>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?
		exit();
	}
	else if($buyer['password'] != $qpasswd)
	{
		print_message("Warning!", "密码错误!", "warning");
		?>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?
		exit();
	}
	else
	{
		$sql_command_qrequest = "SELECT MAX(request_id) FROM requests";
		$last_request = mysqli_fetch_array(mysqli_query($conn, $sql_command_qrequest));
		$id_max = $last_request[0]+1;
		$buyer_id = $buyer['id'];
		$buyer_name = $buyer['name'];
		$sql_command_insert = "INSERT INTO requests (request_id, user_id, product_name, product_temperature, product_addition, request_time, user_name) VALUES
			($id_max, $buyer_id, '$qproduct_name', '$qproduct_temp', '$qproduct_addition', '$qrequest_time', '$buyer_name')";
		mysqli_query($conn, $sql_command_insert);
		print_message("Success!", "购买成功!", "success");
		?>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?
	}
?>
<?php include 'footer.php' ?>
