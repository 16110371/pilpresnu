<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Voting - E-PILPRES</title>

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
			--green-dark: #123524;
			--green-mid: #1b5e20;
			--green-accent: #00c853;
			--green-hover: #00a145;
			--glass-bg: rgba(255, 255, 255, 0.08);
			--glass-border: rgba(255, 255, 255, 0.15);
			--text-muted: #b2dfb6;
			--navbar-height: 64px;
		}

		html,
		body {
			height: 100%;
			overflow: hidden;
		}

		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #123524, #3E7B27);
			color: white;
			display: flex;
			flex-direction: column;
		}

		/* Decorative background pattern */
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

		/* ===== NAVBAR ===== */
		.navbar-modern {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			height: var(--navbar-height);
			padding: 0 30px;
			background: rgba(13, 59, 23, 0.75);
			backdrop-filter: blur(16px);
			-webkit-backdrop-filter: blur(16px);
			border-bottom: 1px solid var(--glass-border);
			z-index: 1000;
			display: flex;
			align-items: center;
		}

		.nav-content {
			width: 100%;
			max-width: 1200px;
			margin: auto;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.logo-text a {
			text-decoration: none;
			font-weight: 700;
			letter-spacing: 3px;
			color: white;
			font-size: 15px;
			text-transform: uppercase;
		}

		.logo-text img {
			height: 36px;
			width: auto;
			display: block;
		}

		.nav-right {
			display: flex;
			align-items: center;
			gap: 15px;
		}

		.username {
			font-size: 13px;
			color: var(--text-muted);
		}

		.logout-btn {
			padding: 7px 18px;
			border-radius: 20px;
			background-color: var(--green-accent);
			color: white;
			text-decoration: none;
			font-size: 13px;
			font-weight: 600;
			transition: background 0.25s ease, transform 0.2s ease;
		}

		.logout-btn:hover {
			background-color: var(--green-hover);
			color: white;
			transform: translateY(-1px);
		}

		/* ===== MAIN LAYOUT ===== */
		.page-wrapper {
			position: relative;
			z-index: 1;
			display: flex;
			flex-direction: column;
			height: 100vh;
			padding-top: var(--navbar-height);
			overflow: hidden;
		}

		/* Desktop: footer di dalam wrapper, ikut flex */
		.page-footer {
			flex-shrink: 0;
		}

		.container {
			flex: 1;
			display: flex;
			flex-direction: column;
			padding: 16px 30px 16px;
			max-width: 1200px;
			width: 100%;
			margin: 0 auto;
			min-height: 0;
		}

		/* ===== PAGE TITLE ===== */
		.page-title {
			text-align: center;
			margin-bottom: 10px;
			flex-shrink: 0;
		}

		.page-title h2 {
			font-family: 'Poppins', sans-serif;
			font-weight: 800;
			font-size: clamp(13px, 1.4vw, 18px);
			line-height: 1.35;
			text-transform: uppercase;
			color: #ffffff;
			text-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);
			letter-spacing: 1px;
		}

		/* ===== CARD GRID ===== */
		.card-grid {
			display: grid;
			gap: 16px;
			flex: 1;
			min-height: 0;
			overflow: hidden;
			justify-content: center;
			margin-bottom: 8px;
		}

		.candidate-card {
			background: var(--glass-bg);
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			border: 1px solid var(--glass-border);
			border-radius: 20px;
			padding: 14px;
			display: flex;
			flex-direction: column;
			gap: 8px;
			transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
			min-height: 0;
			overflow: hidden;
		}

		.candidate-card:hover {
			transform: translateY(-4px);
			box-shadow: 0 16px 40px rgba(0, 0, 0, 0.35);
			background: rgba(255, 255, 255, 0.13);
		}

		.card-number {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 32px;
			height: 32px;
			border-radius: 50%;
			background: var(--green-accent);
			font-weight: 700;
			font-size: 14px;
			flex-shrink: 0;
			align-self: center;
			box-shadow: 0 4px 12px rgba(0, 200, 83, 0.4);
		}

		.card-img-wrap {
			width: 100%;
			flex: 1;
			min-height: 0;
			overflow: hidden;
			border-radius: 14px;
		}

		.candidate-card img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: top center;
			display: block;
			border-radius: 14px;
			transition: transform 0.4s ease;
		}

		.candidate-card:hover img {
			transform: scale(1.03);
		}

		.candidate-card h3 {
			font-size: clamp(12px, 1.2vw, 15px);
			font-weight: 600;
			color: white;
			text-align: center;
			line-height: 1.4;
			flex-shrink: 0;
		}

		.visimisi-btn {
			background: none;
			border: 1px solid rgba(255, 255, 255, 0.2);
			color: var(--text-muted);
			font-family: 'Poppins', sans-serif;
			font-size: clamp(10px, 0.85vw, 12px);
			padding: 5px 14px;
			border-radius: 20px;
			cursor: pointer;
			transition: all 0.25s ease;
			flex-shrink: 0;
			align-self: center;
			letter-spacing: 0.5px;
		}

		.visimisi-btn:hover {
			background: rgba(255, 255, 255, 0.1);
			border-color: rgba(255, 255, 255, 0.4);
			color: white;
		}

		/* ===== PHOTO POPUP ===== */
		.photo-overlay {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.85);
			backdrop-filter: blur(8px);
			-webkit-backdrop-filter: blur(8px);
			z-index: 3000;
			align-items: center;
			justify-content: center;
			padding: 20px;
			cursor: zoom-out;
		}

		.photo-overlay.active {
			display: flex;
		}

		.photo-popup-img {
			max-height: 85vh;
			max-width: 90vw;
			border-radius: 16px;
			object-fit: contain;
			animation: photoIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
			box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
		}

		@keyframes photoIn {
			from {
				opacity: 0;
				transform: scale(0.85);
			}

			to {
				opacity: 1;
				transform: scale(1);
			}
		}

		.card-img-wrap {
			cursor: zoom-in;
		}

		/* ===== MODAL ===== */
		.modal-overlay {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.6);
			backdrop-filter: blur(6px);
			-webkit-backdrop-filter: blur(6px);
			z-index: 2000;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		.modal-overlay.active {
			display: flex;
		}

		.modal-box {
			background: linear-gradient(145deg, #0f3d1a, #1a5c22);
			border: none;
			border-radius: 24px;
			padding: 32px;
			max-width: 480px;
			width: 100%;
			position: relative;
			box-shadow: none;
			animation: modalIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
		}

		@keyframes modalIn {
			from {
				opacity: 0;
				transform: scale(0.88) translateY(20px);
			}

			to {
				opacity: 1;
				transform: scale(1) translateY(0);
			}
		}

		.modal-header {
			display: flex;
			align-items: center;
			gap: 12px;
			margin-bottom: 20px;
		}

		.modal-number {
			width: 36px;
			height: 36px;
			border-radius: 50%;
			background: var(--green-accent);
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: 700;
			font-size: 15px;
			flex-shrink: 0;
			box-shadow: 0 4px 12px rgba(0, 200, 83, 0.4);
		}

		.modal-name {
			font-size: 16px;
			font-weight: 700;
			line-height: 1.3;
		}

		.modal-divider {
			height: 1px;
			background: none;
			margin-bottom: 16px;
		}

		.modal-label {
			font-size: 10px;
			font-weight: 600;
			letter-spacing: 3px;
			text-transform: uppercase;
			color: var(--green-accent);
			margin-bottom: 10px;
		}

		.modal-content {
			font-size: 14px;
			color: #d4edda;
			line-height: 1.8;
			max-height: 260px;
			overflow-y: auto;
			padding-right: 6px;
			background: none;
			border: none;
			outline: none;
			box-shadow: none;
			-webkit-appearance: none;
		}

		.modal-content::-webkit-scrollbar {
			width: 4px;
		}

		.modal-content::-webkit-scrollbar-track {
			background: rgba(255, 255, 255, 0.05);
			border-radius: 4px;
		}

		.modal-content::-webkit-scrollbar-thumb {
			background: var(--green-accent);
			border-radius: 4px;
		}

		.modal-close {
			position: absolute;
			top: 16px;
			right: 16px;
			width: 32px;
			height: 32px;
			border-radius: 50%;
			border: 1px solid rgba(255, 255, 255, 0.2);
			background: rgba(255, 255, 255, 0.08);
			color: white;
			font-size: 16px;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: all 0.2s ease;
		}

		.modal-close:hover {
			background: rgba(255, 255, 255, 0.18);
			border-color: rgba(255, 255, 255, 0.4);
		}

		.ghost-card {
			display: none;
		}

		.vote-form {
			flex-shrink: 0;
		}

		.vote-btn {
			width: 100%;
			padding: 10px 12px;
			border-radius: 25px;
			border: none;
			background: linear-gradient(135deg, #00c853, #00a145);
			color: white;
			font-weight: 700;
			font-size: clamp(10px, 0.9vw, 13px);
			letter-spacing: 0.5px;
			cursor: pointer;
			transition: all 0.3s ease;
			text-transform: uppercase;
			box-shadow: 0 4px 15px rgba(0, 200, 83, 0.3);
		}

		.vote-btn:hover {
			background: linear-gradient(135deg, #00e060, #00c853);
			box-shadow: 0 6px 20px rgba(0, 200, 83, 0.5);
			transform: translateY(-1px);
		}

		.vote-btn:active {
			transform: translateY(0);
		}

		/* ===== FOOTER ===== */
		.page-footer {
			text-align: center;
			padding: 12px 20px 16px;
			font-size: 11px;
			color: white;
			/* letter-spacing: 1.5px; */
			/* text-transform: uppercase; */
			z-index: 1;
			position: relative;
		}

		.page-footer span {
			color: var(--green-accent);
			font-weight: 600;
		}

		/* ===== RESPONSIVE ===== */

		/* Tablet: 2 kolom, dengan scroll */
		@media (max-width: 900px) {

			html,
			body {
				overflow: auto;
				height: auto;
			}

			.page-wrapper {
				height: auto;
				min-height: calc(100vh - var(--navbar-height));
				overflow: visible;
				display: flex;
				flex-direction: column;
			}

			.container {
				flex: 1;
				padding: 16px 20px 16px;
			}

			.page-footer {
				margin-top: 16px;
				padding-bottom: 16px;
			}

			.card-grid {
				grid-template-columns: repeat(2, 1fr) !important;
				gap: 16px;
				flex: none;
				overflow: visible;
			}

			.card-img-wrap {
				flex: none;
				aspect-ratio: 3 / 4;
				height: auto;
			}
		}

		/* Mobile: 1 kolom */
		@media (max-width: 560px) {
			.card-grid {
				grid-template-columns: 1fr;
				gap: 14px;
			}

			.card-img-wrap {
				aspect-ratio: 3 / 4;
			}

			.navbar-modern {
				padding: 0 16px;
			}

			.logo-text a {
				font-size: 12px;
				letter-spacing: 2px;
			}

			.username {
				display: none;
			}

			.page-title h2 {
				font-size: 15px;
			}
		}

		/* Desktop kecil / laptop: pastikan semua muat */
		@media (max-width: 1100px) and (min-width: 901px) {
			.visimisi {
				-webkit-line-clamp: 1;
			}
		}
	</style>
</head>

<body>
	<?php $CI = &get_instance(); ?>
	<!-- NAVBAR -->
	<nav class="navbar-modern">
		<div class="nav-content">
			<div class="logo-text">
				<!-- Ganti dengan <img> jika ada logo -->
				<img src="<?= base_url(); ?>asset/img/logo.png" alt="Logo" style="height: 40px; width: auto;">
			</div>
			<div class="nav-right">
				<span class="username">Selamat Datang, <?= $CI->session->userdata('nama'); ?></span>
				<a href="<?= base_url('user/logout'); ?>" class="logout-btn">Logout</a>
			</div>
		</div>
	</nav>

	<!-- MAIN -->
	<div class="page-wrapper">
		<div class="container">

			<?php
			$jk_now = $datacalon[0]['jk'] ?? '';
			$organisasi = ($jk_now == 'L') ? 'IPNU' : 'IPPNU';
			?>

			<div class="page-title">
				<h2>
					Pemilihan Ketua & Wakil <?= $organisasi; ?><br>
					Komisariat Syubbanul Wathon
				</h2>
			</div>

			<?php $totalCalon = count($datacalon); ?>

			<div class="card-grid" style="grid-template-columns: repeat(<?= $totalCalon; ?>, minmax(0, calc((100% - 3 * 16px) / 4)));"><?php foreach ($datacalon as $index => $loaddata) {
																																			$nomor = $index + 1; ?>

					<div class="candidate-card">

						<div class="card-number"><?= $nomor; ?></div>

						<div class="card-img-wrap" onclick="openPhoto(this)">
							<img src="<?= base_url(); ?>asset/img/<?= $loaddata['photo']; ?>" alt="Foto <?= $loaddata['nama']; ?>">
						</div>

						<h3><?= $loaddata['nama']; ?></h3>

						<?php if (!empty(trim($loaddata['visimisi']))): ?>
							<button class="visimisi-btn"
								data-no="<?= $nomor; ?>"
								data-nama="<?= htmlspecialchars($loaddata['nama'], ENT_QUOTES); ?>"
								data-visimisi="<?= htmlspecialchars($loaddata['visimisi'], ENT_QUOTES); ?>"
								onclick="openModal(this)">
								Lihat Visi &amp; Misi
							</button>
						<?php endif; ?>

						<div class="vote-form">
							<?php echo form_open('user/vote'); ?>
							<input type="hidden" name="nisn" value="<?= $loaddata['nisn']; ?>">
							<input type="hidden" name="username" value="<?= $username; ?>">
							<button type="submit" class="vote-btn">
								Pilih Pasangan No <?= $nomor; ?>
							</button>
							<?php echo form_close(); ?>
						</div>

					</div>

				<?php } ?>
			</div>

		</div>

		<!-- FOOTER -->
		<footer class="page-footer">
			&copy; <?= date('Y'); ?> &nbsp;|&nbsp; Powered by <span> TJKT</span>
		</footer>

	</div>

	<!-- PHOTO POPUP -->
	<div class="photo-overlay" id="photoOverlay" onclick="closePhoto()">
		<img class="photo-popup-img" id="photoPopupImg" src="" alt="Foto Kandidat">
	</div>

	<!-- MODAL -->
	<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
		<div class="modal-box">
			<button class="modal-close" onclick="closeModal()">&#x2715;</button>
			<div class="modal-header">
				<div class="modal-number" id="modalNumber"></div>
				<div class="modal-name" id="modalName"></div>
			</div>
			<div class="modal-divider"></div>
			<div class="modal-label">Visi &amp; Misi</div>
			<div class="modal-content" id="modalContent"></div>
		</div>
	</div>

	<script>
		function openModal(btn) {
			const no = btn.getAttribute('data-no');
			const nama = btn.getAttribute('data-nama');
			const visimisi = btn.getAttribute('data-visimisi');

			document.getElementById('modalNumber').textContent = no;
			document.getElementById('modalName').textContent = nama;
			const formatted = visimisi
				.replace(/\n/g, '<br>')
				.replace(/(Visi\s*:)/gi, '<strong>$1</strong>')
				.replace(/(Misi\s*:)/gi, '<strong>$1</strong>');
			document.getElementById('modalContent').innerHTML = formatted;
			document.getElementById('modalOverlay').classList.add('active');
		}

		function closeModal() {
			document.getElementById('modalOverlay').classList.remove('active');
		}

		function closeModalOutside(e) {
			if (e.target === document.getElementById('modalOverlay')) closeModal();
		}

		function openPhoto(wrap) {
			const src = wrap.querySelector('img').src;
			document.getElementById('photoPopupImg').src = src;
			document.getElementById('photoOverlay').classList.add('active');
		}

		function closePhoto() {
			document.getElementById('photoOverlay').classList.remove('active');
		}

		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape') {
				closeModal();
				closePhoto();
			}
		});
	</script>

</body>

</html>