<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Logout - E-PILPRES</title>

	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

	<style>
		*,
		*::before,
		*::after {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		:root {
			--blue-dark: #172554;
			--blue-mid: #1E3A8A;
			--blue-accent: #3B82F6;
			--blue-hover: #2563EB;

			--glass-bg: rgba(255, 255, 255, .08);
			--glass-border: rgba(255, 255, 255, .15);

			--text-muted: #BFDBFE;
		}

		html,
		body {
			height: 100%;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(145deg,
					#172554 0%,
					#1E3A8A 40%,
					#2563EB 75%,
					#1E40AF 100%);
			color: white;
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
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

		.card {
			position: relative;
			z-index: 1;
			background: var(--glass-bg);
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			border: 1px solid var(--glass-border);
			border-radius: 24px;
			padding: 48px 40px;
			max-width: 420px;
			width: 90%;
			text-align: center;
			animation: fadeIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: scale(0.9) translateY(20px);
			}

			to {
				opacity: 1;
				transform: scale(1) translateY(0);
			}
		}

		.icon-wrap {
			width: 72px;
			height: 72px;
			border-radius: 50%;
			background: linear-gradient(135deg,
					#3B82F6,
					#2563EB);

			box-shadow:
				0 8px 24px rgba(59, 130, 246, .4);
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0 auto 24px;
			font-size: 32px;
			animation: pulse 2s ease-in-out infinite;
		}

		@keyframes pulse {

			0%,
			100% {
				box-shadow: 0 8px 24px rgba(59, 130, 246, .4);
			}

			50% {
				box-shadow: 0 8px 36px rgba(59, 130, 246, .7);
			}
		}

		h2 {
			font-family: 'poppins', sans-serif;
			font-size: 22px;
			font-weight: 800;
			letter-spacing: 1px;
			text-transform: uppercase;
			margin-bottom: 12px;
			color: #ffffff;
		}

		.subtitle {
			font-size: 13px;
			font-weight: 600;
			color: var(--blue-accent);
			letter-spacing: 2px;
			text-transform: uppercase;
			margin-bottom: 20px;
		}

		.divider {
			height: 1px;
			background: var(--glass-border);
			margin: 20px 0;
		}

		p {
			font-size: 13px;
			color: var(--text-muted);
			line-height: 1.8;
			margin-bottom: 28px;
		}

		/* Progress bar */
		.progress-wrap {
			background: rgba(255, 255, 255, 0.1);
			border-radius: 99px;
			height: 4px;
			overflow: hidden;
			margin-bottom: 14px;
		}

		.progress-bar {
			height: 100%;
			width: 0%;
			background: linear-gradient(90deg,
					#3B82F6,
					#60A5FA);
			border-radius: 99px;
			animation: fill 2s linear forwards;
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
			color: var(--blue-accent);
			font-weight: 600;
		}

		@keyframes fill {
			from {
				width: 0%;
			}

			to {
				width: 100%;
			}
		}

		.countdown-text {
			font-size: 11px;
			color: rgba(255, 255, 255, 0.3);
			letter-spacing: 1px;
		}
	</style>
</head>

<body>

	<div class="card">
		<div class="icon-wrap">✓</div>

		<div class="subtitle">Terima Kasih</div>

		<h2>Pemilihan Selesai</h2>

		<div class="divider"></div>

		<p>
			Data Anda berhasil masuk ke sistem.<br>
			Anda akan otomatis keluar
		</p>

		<div class="progress-wrap">
			<div class="progress-bar"></div>
		</div>

		<div class="countdown-text">Mengalihkan halaman...</div>
	</div>

	<div class="footer">
		&copy; <?= date('Y'); ?> &nbsp;|&nbsp; Powered by <span>TJKT</span>
	</div>
	<script>
		setTimeout(function() {
			window.location.href = "<?= base_url('user/logout') ?>";
		}, 2000);
	</script>

</body>

</html>