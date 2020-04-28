<!DOCTYPE html>
<html>
<?php include 'header.php'?>

<?php
	$label_name_map;
	$connection = establish_connection();
	$products = get_types($connection, "drink_types");
	while($row = mysqli_fetch_row($products)) $label_name_map[$row[1]] = $row[0];
?>

<section class="section section-lg section-hero section-shaped">
	<div class="shape shape-style-1 shape-image" style="background-image: url(images/background.jpg); background-size:cover">
		<span class="span-150"></span>
		<span class="span-50"></span>
		<span class="span-50"></span>
		<span class="span-75"></span>
		<span class="span-100"></span>
		<span class="span-75"></span>
		<span class="span-50"></span>
		<span class="span-100"></span>
		<span class="span-50"></span>
		<span class="span-100"></span>
	</div>
	<div class="container shape-container d-flex align-items-center py-lg">
		<div class="col px-0">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-6 text-center">
					<img src="images/avatar5.png" class="avatar" style="margin-bottom: 1rem; height: 150px; width: 150px;">
					<h1 class="text-black"> Buying Lists </h1>
					<hr/>
					<p> <h3 class="text-black"> 在这里购买茶颜悦色，说不定有人会给你送过来 </h3> </p>
				</div>
			</div>
		</div>
	</div>
	<div class="separator separator-bottom separator-skew zindex-100">
		<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
		<polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
		</svg>
	</div>
</section>
<section class="section">
	<div class="container">
		<div class="row py-3">
			<div class="col-sm-8">
				<div class="card shadow">
					<div class="card-body">
						<div class="row row-grid justify-content-center">
							<form action="buy.php" method="post" name="request">
								<div class="content">
									<div class="col">
										<p>
											<div class="text-center">
												<h2> 购买 </h2>
											</div>
										</p>
										<p>
											<div class="mb-3">
												<h4 class="text-uppercase font-bold">种类</h4>
											</div>
											<div class="row">
												<?php
													$table = get_types($connection, "drink_types");
													$initial = 1;
													while($row = mysqli_fetch_array($table))
													{
														?>
															<div class="custom-control custom-radio mb-3 col-sm-4">
																<input name="custom_drink_type" class="custom-control-input" id="<?php echo($row['label']); ?>" value="<?php echo($row[1]); ?>" type="radio" <?php if($initial) echo("checked=''"); ?> >
																<label class="custom-control-label" for="<?php echo($row['label']); ?>">
																	<span><?php echo($row['name']); ?></span>
																	<span><a href="https://www.baidu.com"> 详情 </a></span>
																</label>
															</div>
														<?
														$initial = 0;
													}
												?>
											</div>
										</p>
										<p>
											<div class="mb-3">
												<h4 class="text-uppercase font-bold">温度</h4>
											</div>
											<div class="row">
												<?php
													$table = get_types($connection, "drink_temperatures");
													$initial = 1;
													while($row = mysqli_fetch_array($table))
													{
														?>
															<div class="custom-control custom-radio mb-3 col-sm-3">
																<input name="custom_drink_temperature" class="custom-control-input" id="<?php echo($row['label']); ?>" value="<?php echo($row[1]); ?>" type="radio" <?php if($initial) echo("checked=''"); ?> >
																<label class="custom-control-label" for="<?php echo($row['label']); ?>">
																	<span><?php echo($row['name']); ?></span>
																</label>
															</div>
														<?
														$initial = 0;
													}
												?>
											</div>
										</p>
										<p>
											<div class="mb-3">
												<h4 class="text-uppercase font-bold">备注</h4>
											</div>
											<textarea rows="8" cols="50" name="addition" id="textarea" class="form-control" placeholder="备注" ></textarea>
										</p>
										<p>
											<div class="mb-3">
												<h4 class="text-uppercase font-bold">用户名</h4>
											</div>
											<input type="text" name="user_name" placeholder="比如: zyf" class="form-control form-control-alternative" required="required">
										</p>
										<p>
											<div class="mb-3">
												<h4 class="text-uppercase font-bold">密码</h4>
											</div>
											<input type="password" name="password" placeholder="比如: ******" class="form-control form-control-alternative" required="required">
										</p>
										<hr>
										<p>
											<div class="nav-wrapper">
												<ul class="nav nav-pills flex-column flex-md-row justify-content-center" id="tabs-icons-text" role="tablist">
												<li class="nav-item">
													<button type="submit" class="btn btn-primary">提交订单</button>
												</li>
												<li class="nav-item">
													<a href="index.php"><button type="button" class="btn btn-primary"> 取消购买 </button></a>
												</li>
												<li class="nav-item">
													<a href="reg.php"><button type="button" class="btn btn-primary"> 注册用户 </button></a>
												</li>
												</ul>
											</div>
										</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card shadow">
					<div class="card-body">
						<div class="text-center">
							<h2>
								订单队列
							</h2>
						</div>
					</div>
				</div>
				<hr>
				<?php 
					$queue = get_request_queue($connection, "requests", 10);
					while($row = mysqli_fetch_array($queue))
					{
						?>
						<div class="card shadow">
							<div class="card-body">
								<span class="badge badge-pill badge-danger">
									<small><?php echo($row['user_name']); ?></small>
								</span>
								<span class="badge badge-pill badge-primary">
									<small><?php echo($label_name_map[$row['product_label']]); ?></small>
								</span>
								<span class="badge badge-pill badge-success">
									<small><?php echo($row['request_time']); ?></small>
								</span>
							</div>
						</div>
						<br>
						<?php
					}
				?>
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php' ?>