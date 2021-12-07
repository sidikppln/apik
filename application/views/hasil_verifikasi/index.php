<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Hasil Verifikasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Hasil Verifikasi</li>
          </ol>
        </div>
      </div>
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
          </div>
          <div class="col-lg-6">
            <form action="" method="post" autocomplete="off">
              <div class="input-group">
                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama">
                <button class="btn btn-sm btn-outline-success" type="submit">Cari</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row mb-2">
          <div class="col">
            <a href="<?= base_url('verifikasi-penerimaan'); ?>" class="btn btn-sm btn-outline-success <?= $this->uri->segment(1) == 'verifikasi-penerimaan' ? 'active' : ''; ?>">Belum Verifikasi</a>
            <a href="<?= base_url('hasil-verifikasi'); ?>" class="btn btn-sm btn-outline-success ml-1 <?= $this->uri->segment(1) == 'hasil-verifikasi' ? 'active' : ''; ?>">Sudah Verifikasi</a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <table class="table table-bordered table-hover table-sm">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Jenis</th>
                  <th scope="col">Virtual Account</th>
                  <th scope="col">Nominal</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $page + 1;
                foreach ($penerimaan as $r) : ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= date('d-m-Y', $r['tanggal']); ?></td>
                    <td><?= $r['kdsatker'] . '.' . $r['tahun'] . '.' . $r['kode_kelompok'] . '.' . $r['kode_jenis'] . '.' . $r['no_urut']; ?></td>
                    <td><?= $r['nama_jenis']; ?></td>
                    <td><?= $r['virtual_account']; ?></td>
                    <td class="text-right"><?= number_format($r['debet'], 2, ',', '.'); ?></td>
                    <?php if ($r['nota_penerimaan_id'] == null) : ?>
                      <td>
                        <a href="<?= base_url('hasil-verifikasi/delete/') . $r['id'] . '/' . $r['rekening_koran_id']; ?>" class="btn btn-sm btn-outline-success pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
                      </td>
                    <?php else : ?>
                      <td>
                      </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <?= $name == null ? $pagination : ''; ?>
      </div>
    </div>

  </section>
</div>