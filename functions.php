<?php 

function establish_connection()
{
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
	return $conn;
}

function get_types($table_name)
{
	$conn = establish_connection();
	$sql_command_qname = "SELECT name, label FROM $table_name";
	return mysqli_query($conn, $sql_command_qname);
}

function print_message($left_message, $right_message, $type) //type = "warning" or "success"
{
	?>
	<div class="row justify-content-center mt-6">
		<div class="col-lg-6">
			<div class="alert alert-<?php echo($type); ?> alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
			<span class="alert-inner--text"><strong><?php echo($left_message); ?></strong><?php echo($right_message); ?></span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
			</div>
		</div>
		</br>
	</div>
	<?php
}

?>