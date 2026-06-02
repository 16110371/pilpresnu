<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-VOTE <?= date('Y'); ?> </title>

	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<style>
		*,
		*::before,
		*::after {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			overflow: hidden;
		}

		:root {
			--blue-dark: #172554;
			--blue-mid: #1E3A8A;
			--blue-accent: #3B82F6;
			--blue-hover: #2563EB;

			--glass-bg: rgba(255, 255, 255, 0.08);
			--glass-border: rgba(255, 255, 255, 0.15);

			--text-muted: #BFDBFE;
		}

		html,
		body {
			height: 100%;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg,
					#172554 0%,
					#1E3A8A 45%,
					#2563EB 100%);
			color: white;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			padding: 20px;
		}

		body::before {
			content: '';
			position: fixed;
			inset: 0;
			background-image:
				radial-gradient(circle at 15% 85%, rgba(59, 130, 246, .20) 0%, transparent 40%),
				radial-gradient(circle at 85% 20%, rgba(96, 165, 250, .15) 0%, transparent 35%);
			pointer-events: none;
			z-index: 0;
		}

		/* ===== CARD ===== */
		.login-card {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 400px;
			background: rgba(255, 255, 255, .08);
			backdrop-filter: blur(18px);
			-webkit-backdrop-filter: blur(18px);
			border: 1px solid rgba(255, 255, 255, .15);
			border-radius: 28px;
			padding: 48px 36px;
			text-align: center;
			animation: cardIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
			box-shadow:
				0 10px 30px rgba(0, 0, 0, .25),
				0 0 40px rgba(59, 130, 246, .15);
		}

		@keyframes cardIn {
			from {
				opacity: 0;
				transform: scale(0.92) translateY(20px);
			}

			to {
				opacity: 1;
				transform: scale(1) translateY(0);
			}
		}

		/* ===== LOGO ===== */
		.logo-container {
			margin-bottom: 10px;
		}

		.logo-container img {
			width: auto;
			height: 130px;
		}

		/* ===== TITLE ===== */
		.login-title {
			font-family: 'Poppins', sans-serif;
			font-size: 26px;
			font-weight: 800;
			letter-spacing: 2px;
			color: #ffffff;
			margin-bottom: 4px;
		}

		.subtitle {
			font-size: 11px;
			font-weight: 600;
			letter-spacing: 4px;
			text-transform: uppercase;
			color: var(--blue-accent);
			margin-bottom: 30px;
		}

		/* ===== ALERT ===== */
		.alert-danger,
		.alert-block {
			padding: 11px 16px;
			border-radius: 14px;
			margin-bottom: 20px;
			font-size: 12px;
			text-align: left;
			animation: fadeIn 0.3s ease;
		}

		.alert-danger {
			background: rgba(255, 60, 60, 0.12);
			border: 1px solid rgba(255, 60, 60, 0.3);
			color: #ffb3b3;
		}

		.alert-block {
			background: rgba(255, 165, 0, 0.12);
			border: 1px solid rgba(255, 165, 0, 0.3);
			color: #ffd98a;
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

		/* ===== INPUT ===== */
		.input-group {
			position: relative;
			margin-bottom: 14px;
			width: 100%;
		}

		.input-group i {
			position: absolute;
			left: 18px;
			top: 50%;
			transform: translateY(-50%);
			color: var(--blue-accent);
			font-size: 14px;
			z-index: 1;
		}

		.input-group input {
			width: 100%;
			padding: 13px 20px 13px 46px;
			border-radius: 50px;
			border: 1px solid var(--glass-border);
			background: rgba(255, 255, 255, 0.07);
			color: white;
			font-family: 'Poppins', sans-serif;
			font-size: 13px;
			outline: none;
			transition: border 0.25s ease, background 0.25s ease;
		}

		.input-group input::placeholder {
			color: rgba(255, 255, 255, 0.35);
		}

		.input-group input:focus {
			border-color: var(--blue-accent);
			box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
			background: rgba(255, 255, 255, 0.11);
		}

		/* ===== BUTTON ===== */
		.login-btn {
			width: 100%;
			padding: 13px;
			margin-top: 8px;
			border-radius: 50px;
			border: none;

			background: linear-gradient(135deg,
					#3B82F6,
					#2563EB);
			background-clip: padding-box;
			color: white;
			font-weight: 700;
			letter-spacing: 1px;

			cursor: pointer;

			transition: all .3s ease;

			/* box-shadow:
				0 4px 20px rgba(20, 184, 166, .35); */
		}

		.login-btn:hover {
			background: linear-gradient(135deg,
					#60A5FA,
					#3B82F6);
			/* box-shadow: 0 6px 20px rgba(59, 130, 246, .5); */
			transform: translateY(-2px);
		}

		.login-btn:active {
			transform: translateY(0);
		}

		/* ===== FOOTER ===== */
		.footer {
			position: fixed;
			bottom: 12px;
			left: 0;
			right: 0;
			z-index: 1;
			font-size: 11px;

			color: white;
			/* letter-spacing: 1.5px;
			text-transform: uppercase; */
			text-align: center;
		}

		.footer span {
			color: #60A5FA;
			font-weight: 600;
		}

		/* ===== RESPONSIVE ===== */
		@media (max-width: 480px) {
			.login-card {
				padding: 36px 24px;
			}
		}
	</style>
</head>

<body>

	<div class="login-card">

		<div class="logo-container">
			<img src="<?php echo base_url('asset/img/api.png'); ?>" alt="Logo">
		</div>

		<h2 class="login-title">E-VOTE</h2>
		<p class="subtitle">SYUBBANUL WATHON</p>

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
		&copy; <?= date('Y'); ?> &nbsp;|&nbsp; Powered by <span>TJKT</span>
	</div>

</body>

</html>