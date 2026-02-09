<center>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-inner">
						<div class="box-header well">
							<h2 class="text-danger bold">KELUAR</h2>
						</div>
						<div class="box-content">
							<h4 class="text-danger">
								<b>TERIMA KASIH TELAH MELAKUKAN PEMILIHAN</b>
							</h4>

							<p>
								Data anda berhasil masuk sistem.<br>
								Anda akan otomatis keluar...
							</p>

							<center>
								<button class="btn btn-info" disabled>
									<span class="glyphicon glyphicon-log-out"></span>
									&nbsp; LOGOUT
								</button>
							</center>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</center>

<script>
	setTimeout(function() {
		window.location.href = "<?= base_url('user/logout') ?>";
	}, 2000);
</script>