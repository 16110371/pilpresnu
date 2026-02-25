<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login E-PILPRES IPNU • IPPNU</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		body {
			min-height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			background: linear-gradient(135deg, #123524, #3E7B27);
			padding: 20px;
		}

		/* CARD */
		.login-card {
			width: 100%;
			max-width: 400px;
			background-color: #5b8451;
			padding: 60px 35px;
			border-radius: 30px;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
			text-align: center;
		}

		/* LOGO */
		.logo-container {
			margin-bottom: 25px;
		}

		.logo-container img {
			width: 170px;
			height: auto;
		}

		/* TITLE */
		.login-title {
			color: white;
			font-size: 22px;
			letter-spacing: 2px;
			margin-bottom: 5px;
		}

		.subtitle {
			color: #e0e0e0;
			font-size: 13px;
			letter-spacing: 3px;
			margin-bottom: 35px;
		}

		/* INPUT */
		.input-group {
			position: relative;
			margin-bottom: 18px;
			width: 100%;
		}

		.input-group i {
			position: absolute;
			left: 18px;
			top: 50%;
			transform: translateY(-50%);
			color: #2e7d32;
			font-size: 16px;
		}

		.input-group input {
			width: 100%;
			padding: 14px 20px 14px 45px;
			border-radius: 50px;
			border: none;
			outline: none;
			font-size: 14px;
		}

		/* BUTTON */
		.login-btn {
			width: 100%;
			padding: 14px;
			margin-top: 10px;
			border-radius: 50px;
			border: none;
			background-color: #2e7d32;
			color: white;
			font-weight: bold;
			font-size: 15px;
			cursor: pointer;
			transition: 0.3s ease;
		}

		.login-btn:hover {
			background-color: #123524;
			transform: translateY(-2px);
		}

		/* FOOTER */
		.footer {
			position: fixed;
			bottom: 10px;
			width: 100%;
			text-align: center;
			font-size: 13px;
			color: white;
		}

		/* RESPONSIVE */
		@media (max-width: 480px) {
			.login-card {
				padding: 45px 25px;
			}
		}

		/* ALERT */
		.alert-danger,
		.alert-block {
			padding: 12px 15px;
			border-radius: 15px;
			margin-bottom: 20px;
			font-size: 13px;
			animation: fadeIn 0.3s ease-in-out;
		}

		.alert-danger {
			background: rgba(255, 0, 0, 0.15);
			border: 1px solid rgba(255, 0, 0, 0.4);
			color: #fff;
		}

		.alert-block {
			background: rgba(255, 165, 0, 0.15);
			border: 1px solid rgba(255, 165, 0, 0.4);
			color: #fff;
		}

		.alert-danger i,
		.alert-block i {
			margin-right: 6px;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(-5px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>

<body>

	<div class="login-card">

		<div class="logo-container">
			<img src="<?php echo base_url('asset/img/logo2.png'); ?>" alt="Logo">
		</div>

		<h2 class="login-title">E-PILPRES</h2>
		<p class="subtitle">IPNU • IPPNU</p>
		<?php if ($this->session->flashdata('failed')) { ?>
			<div class="alert-danger">
				<i class="fas fa-circle-exclamation"></i>
				<?php echo $this->session->flashdata('failed'); ?>
			</div>
		<?php } ?>

		<?php if ($this->session->flashdata('block')) { ?>
			<div class="alert-block">
				<i class="fas fa-ban"></i>
				<?php echo $this->session->flashdata('block'); ?>
			</div>
		<?php } ?>
		<?php echo form_open('user/loginvalidation'); ?>

		<div class="input-group">
			<i class="fas fa-user"></i>
			<input type="text" name="username" placeholder="Username" required>
		</div>

		<div class="input-group">
			<i class="fas fa-lock"></i>
			<input type="password" name="password" placeholder="Password" required>
		</div>

		<button type="submit" class="login-btn">LOGIN</button>

		<?php echo form_close(); ?>

	</div>
	<div class="footer">
		<?php echo $this->config->item('tahun_kegiatan') . " © " . $this->config->item('nama_aplikasi'); ?>
	</div>
</body>

</html>