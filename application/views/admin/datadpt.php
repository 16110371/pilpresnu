<?php ini_set('display_errors', 1);
error_reporting(E_ALL); ?>
<?php echo "CHECKPOINT 1"; ?>
<div class="row">
    <div class="col-lg-8">
    </div>
    <?php echo "CHECKPOINT 2"; ?>
    <div class="col-lg-8">
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2>DAFTAR DPT</h2>
                </div>
                <div class="box-content">
                    <?php echo "CHECKPOINT 3"; ?>
                    <?php
                    $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
                    echo form_open("admin/search", $attr);
                    ?>
                    <?php echo "CHECKPOINT 4"; ?>
                    <div class="form-group">
                        <div class="col-md-8">
                            <input class="form-control" id="search_text" name="search_text" placeholder="Cari Data DPT" type="text" value="<?php echo set_value('search_text'); ?>" />
                        </div>
                        <div class="col-md-4">
                            <input id="btn_search" name="btn_search" type="submit" class="btn btn-sm btn-success" value="CARI DATA" />
                            <a href="<?php echo base_url() . "admin/datadpt"; ?>" class="btn btn-sm btn-info">SEMUA DATA</a>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <?php echo "CHECKPOINT 5"; ?>

                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                            <th class="text-center">No</th>
                            <th class="text-center">NISN</th>
                            <th class="text-center">Nama Siswa</th>
                            <th class="text-center">L/P</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                        <tbody>
                            <?php echo "CHECKPOINT 6"; ?>
                            <?php for ($i = 0; $i < count($datadpt); ++$i) { ?>
                                <tr>
                                    <td><?php echo ($page + $i + 1); ?></td>
                                    <td><?php echo $datadpt[$i]->username; ?></td>
                                    <td><?php echo $datadpt[$i]->nm_siswa; ?></td>
                                    <td><?php echo $datadpt[$i]->jk; ?></td>
                                    <td><?php echo $datadpt[$i]->nm_kelas; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('index.php/admin/editdpt'); ?>/<?php echo $datadpt[$i]->username; ?>"><button type="button" class="btn btn-xs btn-info">Edit</button></a>
                                        <a href="<?php echo base_url('index.php/admin/hapusdpt'); ?>/<?php echo $datadpt[$i]->username; ?>"><button type="button" class="btn btn-xs btn-danger">Hapus</button></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php echo "CHECKPOINT 7"; ?>
                    <?php echo $pagination; ?>
                    <?php echo "CHECKPOINT 8"; ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo "CHECKPOINT 9"; ?>
    <div class="col-lg-4">
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2>TAMBAH DPT</h2>
                </div>
                <div class="box-content">
                    <?php echo "CHECKPOINT 10"; ?>
                    <?php $CI = &get_instance();
                    if ($CI->session->flashdata('info')) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <?php echo $CI->session->flashdata('info'); ?>
                        </div>
                    <?php } ?>
                    <?php if ($CI->session->flashdata('failed')) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <?php echo $CI->session->flashdata('failed'); ?>
                        </div>
                    <?php } ?>
                    <?php echo "CHECKPOINT 11"; ?>
                    <?php
                    $form_attribute = array('method' => 'post', 'class' => 'form-horizontal');
                    echo form_open_multipart('admin/simpandpt', $form_attribute);
                    ?>
                    <?php echo "CHECKPOINT 12"; ?>
                    <label class="label-control">NISN</label>
                    <?php echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'nisn')); ?>
                    <label class="label-control">Nama</label>
                    <?php echo form_input(array('type' => 'text', 'class' => 'form-control', 'name' => 'nm_siswa')); ?>
                    <label class="label-control">Jenis Kelamin</label>
                    <select class="form-control" name="jk">
                        <option selected value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <?php echo "CHECKPOINT 13"; ?>
                    <label class="label-control">Kelas</label>
                    <select class="form-control" name="kd_kelas">
                        <option selected value="">Pilih Daftar Kelas</option>
                        <?php foreach ($datakelas as $load) { ?>
                            <option value="<?php echo $load['kd_kelas']; ?>"><?php echo $load['nm_kelas']; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo "CHECKPOINT 14"; ?>
                    <br />
                    <button type="submit" class="btn btn-sm btn-info">SIMPAN DATA</button>
                    <?php echo form_close(); ?>
                    <?php echo "CHECKPOINT 15"; ?>
                </div>
            </div>
        </div>
        <?php echo "CHECKPOINT 16"; ?>
        <div class="box">
            <div class="box-inner">
                <div class="box-header well">
                    <h2>UPLOAD TEMPLATE EXCEL</h2>
                </div>
                <div class="box-content">
                    <?php echo "CHECKPOINT 17"; ?>
                    <form name="f_siswa" action="<?php echo base_url(); ?>import/siswa" id="f_siswa" enctype="multipart/form-data" method="post">
                        <input type="file" class="form-control col-md-3" name="import_excel" required>
                        <br><br>
                        <button type="submit" class="btn btn-sm btn-warning">UPLOAD DATA</button>
                        <a href="<?= site_url('import/download_template'); ?>" class="btn btn-sm btn-success">DOWNLOAD TEMPLATE</a>
                    </form>
                    <?php echo "CHECKPOINT 18 - SELESAI"; ?>
                </div>
            </div>
        </div>
    </div>
</div>