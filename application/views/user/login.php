<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login E-PILPRES IPNU • IPPNU</title>

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
			--green-dark: #0d3b17;
			--green-mid: #1b5e20;
			--green-accent: #00c853;
			--green-hover: #00a145;
			--glass-bg: rgba(255, 255, 255, 0.08);
			--glass-border: rgba(255, 255, 255, 0.15);
			--text-muted: #b2dfb6;
		}

		html,
		body {
			height: 100%;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(145deg, #0d3b17 0%, #1b5e20 40%, #2e7d32 70%, #1a4a1e 100%);
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
				radial-gradient(circle at 15% 85%, rgba(0, 200, 83, 0.12) 0%, transparent 40%),
				radial-gradient(circle at 85% 20%, rgba(0, 200, 83, 0.08) 0%, transparent 35%),
				radial-gradient(circle at 50% 50%, rgba(0, 0, 0, 0.15) 0%, transparent 70%);
			pointer-events: none;
			z-index: 0;
		}

		/* ===== CARD ===== */
		.login-card {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 400px;
			background: var(--glass-bg);
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			border: 1px solid var(--glass-border);
			border-radius: 28px;
			padding: 48px 36px;
			text-align: center;
			animation: cardIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
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
			margin-bottom: 20px;
		}

		.logo-container img {
			width: 150px;
			height: auto;
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
			color: var(--green-accent);
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
			color: var(--green-accent);
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
			border-color: var(--green-accent);
			background: rgba(255, 255, 255, 0.11);
		}

		/* ===== BUTTON ===== */
		.login-btn {
			width: 100%;
			padding: 13px;
			margin-top: 8px;
			border-radius: 50px;
			border: none;
			background: linear-gradient(135deg, #00c853, #00a145);
			color: white;
			font-family: 'Poppins', sans-serif;
			font-weight: 700;
			font-size: 14px;
			letter-spacing: 1px;
			cursor: pointer;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(0, 200, 83, 0.35);
		}

		.login-btn:hover {
			background: linear-gradient(135deg, #00e060, #00c853);
			box-shadow: 0 6px 20px rgba(0, 200, 83, 0.5);
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
			color: var(--green-accent);
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
			<img src="<?php echo base_url('asset/img/logo2.png'); ?>" alt="Logo">
		</div>

		<h2 class="login-title">E-PILPRES</h2>
		<p class="subtitle">IPNU &bull; IPPNU</p>

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