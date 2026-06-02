<div class="row">
	<div class="col-lg-4">
		<div class="box">
			<div class="box-inner">
				<div class="box-header well">
					<h2>TAMBAH KANDIDAT CALON PEMILIHAN</h2>
				</div>
				<div class="box-content">
					<?php if ($this->session->flashdata('info')) { ?>
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $this->session->flashdata('info'); ?>
						</div>
					<?php } ?>
					<?php if ($this->session->flashdata('failed')) { ?>
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $this->session->flashdata('failed'); ?>
						</div>
					<?php } ?>
					<?php
					$form_attribute = array(
						'method'	=> 'post',
						'class'		=> 'form-horizontal'
					);
					echo form_open_multipart('admin/simpancalon', $form_attribute);
					?>
					<!-- <div class="form-container" style="width: 400px;"> -->
					<label class="label-control"> NISN</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'text',
						'name'		=> 'nisn',
						'class'		=> 'form-control'
					);
					echo form_input($form_attribute);
					?>
					<label class="label-control"> Nomor Pasangan Calon</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'text',
						'name'		=> 'no',
						'class'		=> 'form-control'
					);
					echo form_input($form_attribute);
					?>
					<label class="label-control"> Nama Pasangan Calon</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'text',
						'name'		=> 'nama',
						'class'		=> 'form-control'
					);
					echo form_input($form_attribute);
					?>
					<label class="label-control">Tahun Khidmah</label>
					<input type="text"
						name="tahun_khidmah"
						class="form-control"
						placeholder="Contoh: Angkatan MAZZA 2 (Pengurus tahun ke-3)">
					<label class="label-control">Alamat</label>
					<input type="text"
						name="alamat"
						class="form-control"
						placeholder="Contoh: Candimulyo">
					<label class="label-control">Jenjang Pendidikan</label>
					<input type="text"
						name="jenjang_pendidikan"
						class="form-control"
						placeholder="Contoh: Salaf">
					<label class="label-control"> Jenis Kelamin Calon</label>
					<?php
					$options = array(
						''  => '-- Pilih Jenis Kelamin --',
						'L' => 'Laki-laki',
						'P' => 'Perempuan'
					);

					echo form_dropdown(
						'jk',
						$options,
						'',
						'class="form-control" required'
					);
					?>
					<label class="label-control">Kategori Pemilihan</label>

					<?php
					$options = array(
						'' => '-- Pilih Kategori --',

						'kepala_pondok_putra_tepo'        => 'Kepala Pondok Putra Tepo',
						'wakil_kepala_pondok_putra_tepo'  => 'Wakil Kepala Pondok Putra Tepo',

						'kepala_pondok_putri_tepo'        => 'Kepala Pondok Putri Tepo',
						'wakil_kepala_pondok_putri_tepo'  => 'Wakil Kepala Pondok Putri Tepo',

						'wakil_kepala_pondok_putri_pagutan' => 'Wakil Kepala Pondok Putri Pagutan'
					);

					echo form_dropdown(
						'kategori',
						$options,
						'',
						'class="form-control" required'
					);
					?>
					<label class="label-control"> Foto</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'file',
						'name'		=> 'photo',
						'class'		=> 'form-control'
					);
					echo form_input($form_attribute);
					?>
					<label class="label-control">Jabatan Pondok</label>

					<textarea
						name="jabatan_pondok"
						class="form-control"
						rows="5"
						placeholder="2024/2025|Kebersihan
2025/2026|Kebersihan"></textarea>

					<small class="text-muted">
						Format:
						Tahun|Jabatan
						Satu baris satu data
					</small>
					<br />
					<button type="submit" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;SIMPAN DATA</button>
					<!-- </div> -->
					<?php
					echo form_close();
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<div class="box">
			<div class="box-inner">
				<div class="box-header well">
					<h2>DAFTAR KANDIDAT CALON PEMILIHAN</h2>
				</div>
				<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama Calon</th>
								<th class="text-center">Tahun Khidmah</th>
								<th class="text-center">Alamat</th>
								<th class="text-center">Jenjang Pendidikan</th>
								<th class="text-center">Jenis Kelamin</th>
								<th class="text-center">Photo Calon</th>
								<th class="text-center" width="150">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($datacalon as $loaddata) {
							?>
								<tr>
									<td class="text-center"><?php echo $loaddata['no']; ?></td>
									<td><?php echo $loaddata['nama']; ?></td>
									<td><?php echo $loaddata['tahun_khidmah']; ?></td>
									<td><?php echo $loaddata['alamat']; ?></td>
									<td class="text-center"><?php echo $loaddata['jenjang_pendidikan']; ?></td>
									<td class="text-center"><?php echo $loaddata['jk']; ?></td>
									<td class="text-center"><img width="50" src="<?php echo base_url(); ?>/asset/img/<?php echo $loaddata['photo']; ?>"></td>
									<td>
										<a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>admin/editcalon/<?php echo $loaddata['nisn']; ?>">
											<i class="glyphicon glyphicon-edit icon-white"></i> Edit
										</a>
										<a class="btn btn-xs btn-danger" href="<?php echo base_url(); ?>admin/hapuscalon/<?php echo $loaddata['nisn']; ?>">
											<i class="glyphicon glyphicon-trash icon-white"></i>
											Hapus
										</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>