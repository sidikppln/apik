<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APIK System</title>
  <link rel="shortcut icon" href="<?= base_url(); ?>asset/img/apik.png" type=" image/x-icon">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>asset/css/adminlte.min.css">
</head>

<body class="hold-transition lockscreen">

  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <div class="error-page">
          <h2 class="headline text-danger">400</h2>
          <div class="error-content">
            <h3><i class="fa fa-warning text-danger"></i> Oops! Halaman tidak ditemukan.</h3>
            <p>
              Kami tidak bisa menemukan halaman yang Anda cari.
              User Anda belum terdaftar di modul ini. Hubungi administrator untuk mendapatkan bantuan.
            </p>
            <p>
              <a class="btn btn-sm btn-success" href="<?= base_url('auth'); ?>"><i class="fas fa-sign-in-alt"></i> &nbsp;Kembali ke halaman login</a>
              <a class="btn btn-sm btn-danger" href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Apakah Anda yakin akan keluar dari aplikasi ini?')"><i class="fas fa-power-off"></i> &nbsp;Logout</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="<?= base_url(); ?>asset/js/jquery.min.js"></script>
  <script src="<?= base_url(); ?>asset/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>asset/js/adminlte.min.js"></script>

</body>

</html>