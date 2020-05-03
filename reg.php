<!DOCTYPE html>
<html>
<?php include 'header.php' ?>
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
	<div class="row justify-content-center">
		<div class="card shadow">
			<div class="card-body">
				<form method="post" action="reg_check.php" name="register_form">
					<div class="col">
						<div class="row justify-content-center mb-3">
							<h1 class="font-weight-bold">注册</h1>
						</div>
						<div class="row mb-3">
							<h5 class="font-weight-bold">用户名：</h5>
							<input type="text" name="user_name" placeholder="格式为年级-班级-姓名,如g2017-24班-zyf" class="form-control form-control-alternative" required="required">
						</div>
						<div class="row mb-3">
							<h5 class="font-weight-bold">密码：</h5>
							<input type="password" name="password1" placeholder="比如: zyfzyfzyf" class="form-control form-control-alternative" required="required">
						</div>
						<div class="row mb-3">
							<h5 class="font-weight-bold">确认密码：</h5>
							<input type="password" name="password2" placeholder="比如: zyfzyfzyf" class="form-control form-control-alternative" required="required">
						</div>
						<div class="row justify-content-center">
							<button type="submit" class="btn btn-primary">确认注册</button>
							<a href="index.php"><button type="button" class="btn btn-primary"> 返回首页 </button></a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<?php include 'footer.php' ?>