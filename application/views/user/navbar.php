<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

  <div class="navbar-modern">
    <div class="nav-content">
      <div class="logo-text">
        <a href="<?= base_url('user'); ?>">
          <img src="<?= base_url('asset/img/logo.png'); ?>" alt="Logo">
        </a>
      </div>

      <div class="nav-right">
        <span class="username">
          Selamat datang, <?= $this->session->userdata('nm_siswa'); ?>
        </span>

        <a href="<?= base_url('user/logout'); ?>" class="logout-btn">
          Logout
        </a>
      </div>
    </div>
  </div>

<?php } ?>