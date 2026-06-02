<?php
foreach ($datacalon as $loaddata) {
}
?>
<div class="row">
	<div class="col-lg-4">
		<div class="box">
			<div class="box-inner">
				<div class="box-header well">
					<h2>EDIT DATA KANDIDAT CALON</h2>
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
					echo form_open_multipart('admin/updatecalon', $form_attribute);
					?>
					<label class="label-control"> NISN</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'text',
						'name'		=> 'nisn',
						'class'		=> 'form-control',
						'readonly'	=> '',
						'value'		=> $loaddata['nisn']
					);
					echo form_input($form_attribute);
					?>
					<label class="label-control"> No Pemilihan</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'text',
						'name'		=> 'no',
						'class'		=> 'form-control',
						'value'		=> $loaddata['no']
					);
					echo form_input($form_attribute);
					?>
					<label class="label-control"> Nama Calon</label>
					<?php
					echo form_input([
						'type'  => 'text',
						'name'  => 'nama',
						'class' => 'form-control',
						'value' => $loaddata['nama']
					]);
					?>

					<label class="label-control"> Kategori Pemilihan</label>
					<?php
					echo form_dropdown(
						'kategori',
						[
							'kepala_pondok_putra_tepo' => 'Kepala Pondok Putra Tepo',
							'wakil_kepala_pondok_putra_tepo' => 'Wakil Kepala Pondok Putra Tepo',
							'kepala_pondok_putri_tepo' => 'Kepala Pondok Putri Tepo',
							'wakil_kepala_pondok_putri_tepo' => 'Wakil Kepala Pondok Putri Tepo',
							'wakil_kepala_pondok_putri_pagutan' => 'Wakil Kepala Pondok Putri Pagutan'
						],
						$loaddata['kategori'],
						'class="form-control"'
					);
					?>

					<label class="label-control"> Jenis Kelamin</label>
					<?php
					echo form_dropdown(
						'jk',
						[
							'L' => 'Laki-laki',
							'P' => 'Perempuan'
						],
						$loaddata['jk'],
						'class="form-control"'
					);
					?>

					<label class="label-control"> Visi</label>
					<?php
					echo form_textarea([
						'name'  => 'visi',
						'class' => 'form-control',
						'rows'  => 3,
						'value' => $loaddata['visi']
					]);
					?>

					<label class="label-control"> Misi</label>
					<?php
					echo form_textarea([
						'name'  => 'misi',
						'class' => 'form-control',
						'rows'  => 4,
						'value' => $loaddata['misi']
					]);
					?>

					<label class="label-control"> Tahun Khidmah</label>
					<?php
					echo form_input([
						'type'  => 'text',
						'name'  => 'tahun_khidmah',
						'class' => 'form-control',
						'value' => $loaddata['tahun_khidmah']
					]);
					?>

					<label class="label-control"> Alamat</label>
					<?php
					echo form_textarea([
						'name'  => 'alamat',
						'class' => 'form-control',
						'rows'  => 2,
						'value' => $loaddata['alamat']
					]);
					?>

					<label class="label-control"> Jenjang Pendidikan</label>
					<?php
					echo form_input([
						'type'  => 'text',
						'name'  => 'jenjang_pendidikan',
						'class' => 'form-control',
						'value' => $loaddata['jenjang_pendidikan']
					]);
					?>

					<label class="label-control"> Jabatan Pondok</label>
					<?php
					echo form_input([
						'type'  => 'text',
						'name'  => 'jabatan_pondok',
						'class' => 'form-control',
						'value' => $loaddata['jabatan_pondok']
					]);
					?>
					<label class="label-control"> Foto</label>
					<?php
					$form_attribute	= array(
						'type'		=> 'file',
						'name'		=> 'photo',
						'class'		=> 'form-control',
						'value'		=> $loaddata['photo']
					);
					echo form_input($form_attribute);
					?>
					<br />
					<button type="submit" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;&nbsp;UPDATE DATA</button>
					<a href="<?php echo base_url('admin/datacalon'); ?>" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;&nbsp;KEMBALI</a>
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
					<h2>DETAIL KANDIDAT/CALON</h2>
				</div>
				<div class="box-content">
					<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">NISN</th>
								<th class="text-center">Nama Calon</th>
								<th class="text-center">Kategori</th>
								<th class="text-center">Photo Calon</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($datacalon as $loaddata) {
							?>
								<tr>
									<td class="text-center"><?php echo $no++; ?></td>
									<td class="text-center"><?php echo $loaddata['nisn']; ?></td>
									<td class="text-center"><?php echo $loaddata['nama']; ?></td>
									<td class="text-center"><?php echo $loaddata['kategori']; ?></td>
									<td class="text-center"><img width="50" src="<?php echo base_url(); ?>/asset/img/<?php echo $loaddata['photo']; ?>"></td>
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