<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pengguna</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="#">Pengguna</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <div class="row">
      <div class="col">
        <?php if ($this->session->flashdata('pesan')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> <?= $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <a href="<?= base_url('pengguna/create/'); ?>" class="btn btn-sm btn-outline-success">Tambah</a>
          </div>
          <div class="col-lg-6">
            <form action="" method="post" autocomplete="off">
              <div class="input-group">
                <input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama">
                <button class="btn btn-sm btn-outline-secondary" type="submit">Cari</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">NIP</th>
              <th scope="col">Nama</th>
              <th scope="col">Is_active</th>
              <th scope="col">Tgl Update</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $page + 1;
            foreach ($pengguna as $r) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $r['nip']; ?></td>
                <td><?= $r['nama']; ?></td>
                <td><?= $r['is_active']; ?></td>
                <td><?= date('d-m-Y', $r['date_created']); ?></td>
                <td>
                  <a href="<?= base_url('pengguna/update/') . $r['id']; ?>" class="btn btn-sm btn-outline-warning">Ubah</a>
                  <a href="<?= base_url('pengguna/delete/') . $r['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <?= $name == null ? $pagination : ''; ?>
      </div>
    </div>

  </section>
</div>