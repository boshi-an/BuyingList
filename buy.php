<!DOCTYPE html>
<html>
<?php include 'header.php' ?>

<?php
	function report_error($info)
	{
		print_message("Warning!", $info, "warning");
		?>
		<div class="row justify-content-center mb-4">
			<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
		</div>
		<?
	}

	$conn = establish_connection();
	$qname = $_POST['user_name'];
	$qpasswd = $_POST['password'];
	$qproduct_label = $_POST['custom_drink_type'];
	$qproduct_temp = $_POST['custom_drink_temperature'];
	$qproduct_addition = $_POST['addition'];
	ini_set('date.timezone', 'Asia/Shanghai');
	$qrequest_time = date("Y-m-d H:i:s");
	$sql_command_quser = "SELECT * FROM `users` WHERE name='$qname'";
	$buyer = mysqli_fetch_array(mysqli_query($conn, $sql_command_quser));
	if(empty($buyer))
	{
		report_error("没有这个用户!");
		exit();
	}
	else if($buyer['confirmed'] != 1)
	{
		report_error("该用户未通过审核!");
		exit();
	}
	else if($buyer['password'] != $qpasswd)
	{
		report_error("密码错误!");
		exit();
	}
	else
	{
		$sql_command_qrequest = "SELECT MAX(request_id) FROM `requests`";
		$last_request = mysqli_fetch_array(mysqli_query($conn, $sql_command_qrequest));
		$id_max = $last_request[0]+1;
		$sql_command_qrequest = "SELECT COUNT(*) FROM `requests` WHERE to_days(now())-to_days(request_time) < 1";
		$num_request = mysqli_fetch_array(mysqli_query($conn, $sql_command_qrequest));
		$sql_command_qlimit = "SELECT * FROM `flags` WHERE `name` LIKE 'max_request_per_day'";
		$num_limit = mysqli_fetch_array(mysqli_query($conn, $sql_command_qlimit));

		if($num_request['COUNT(*)'] >= intval($num_limit['var']))
		{
			report_error("今天的请求已经够多啦，跑腿的忙不过来了，下次早点购买。");
		}
		else
		{
			$buyer_id = $buyer['id'];
			$buyer_name = $buyer['name'];
			$sql_command_insert = "INSERT INTO requests (request_id, user_id, user_name, product_label, product_temperature, product_addition, request_time, confirmed, confirm_time) VALUES
				($id_max, $buyer_id, '$buyer_name', '$qproduct_label', '$qproduct_temp', '$qproduct_addition', '$qrequest_time', 0, '$qrequest_time')";
			$ret = mysqli_query($conn, $sql_command_insert);
			if($ret == true)
			{
				print_message("Success!", "购买成功!", "success");
				?>
				<div class="row justify-content-center mb-4">
					<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
				</div>
				<?
			}
			else
			{
				report_error("好像什么东西出错了，可能是请求中包含非法字符。");
			}
		}
		exit();
	}
?>
<?php include 'footer.php' ?>
